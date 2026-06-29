<?php

namespace Progrupa\Sketchup3DWarehouseBundle;

use GuzzleHttp\Exception\RequestException;
use Symfony\Component\Serializer\Exception\ExceptionInterface as SerializerExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Progrupa\Sketchup3DWarehouseBundle\Model\Collection;
use Progrupa\Sketchup3DWarehouseBundle\Model\Entity;
use Progrupa\Sketchup3DWarehouseBundle\Model\GenericResource;
use Progrupa\Sketchup3DWarehouseBundle\Model\HierarchicalResource;
use Progrupa\Sketchup3DWarehouseBundle\Model\MultipartResource;
use Progrupa\Sketchup3DWarehouseBundle\Model\SubjectClass;
use Progrupa\Sketchup3DWarehouseBundle\Model\WarehouseRelation;
use Progrupa\Sketchup3DWarehouseBundle\Model\Resource;
use Progrupa\Sketchup3DWarehouseBundle\Model\WarehouseResource;
use Progrupa\Sketchup3DWarehouseBundle\Search\Query;
use Progrupa\Sketchup3DWarehouseBundle\Search\Result;
use Psr\Http\Message\ResponseInterface;

class Client
{
    /** @var  \GuzzleHttp\Client */
    private $guzzle;
    /** @var  SerializerInterface */
    private $serializer;
    /** @var  array */
    private $auth;

    public function __construct(\GuzzleHttp\Client $guzzle, SerializerInterface $serializer, $authId = null, $secret = null)
    {
        $this->guzzle = $guzzle;
        $this->serializer = $serializer;
        if ($authId and $secret) {
            $this->auth = [$authId, $secret];
        }
    }

    /**
     * @param string $authId
     * @param string $secret
     * @return $this
     */
    public function setAuth($authId, $secret)
    {
        $this->auth = [$authId, $secret];

        return $this;
    }

    public function getResource(WarehouseResource $entity)
    {
        try {
            $guzzleResponse = $this->guzzle->get(
                $entity->getResource(),
                $this->prepareOptions()
            );
            $response = $this->convertResponse($guzzleResponse);

            $response->setEntity($this->entityFromResponse($guzzleResponse, $entity));

            return $response;
        } catch (RequestException $e) {
            return $this->convertResponse($e->getResponse());
        }
    }

    /**
     * @param Query $query
     * @return Result
     */
    public function search(Query $query)
    {
        try {
            $extraOptions = $this->serializer->normalize($query, 'array');
            $extraOptions['fq'] = $this->convertToFiql($extraOptions['fq']);

            $guzzleResponse = $this->guzzle->get(
                $query->getClass(),
                $this->prepareOptions(
                    ['query' => $extraOptions
                    ]
                )
            );

            $response = $this->convertSearchResult($guzzleResponse);

            return $response;
        } catch (RequestException $e) {
            return $this->convertSearchResult($e->getResponse());
        }
    }

    public function updateResource(WarehouseResource $resource)
    {
        try {
            $groups = ['Default', 'update'];
            $updateParameters = array_merge(
                $this->serializer->normalize($resource, 'array', [AbstractNormalizer::GROUPS => $groups]),
                $resource->extraAttributes($groups)
            );

            if ($resource instanceof MultipartResource) {
                $extraOptions = ['multipart' => $this->convertToMultipart([
                        'dto' => $this->serializer->serialize($updateParameters, 'json'),
                        'file' => is_resource($resource->file()) ? $resource->file() : fopen($resource->file(), 'r'),
                    ])
                ];
            } else {
                $extraOptions = ['json' => $updateParameters];
            }

            $response = $this->convertResponse(
                $this->guzzle->request(
                    $resource->getId() ? "PATCH" : "POST",
                    $resource->getResource(),
                    $this->prepareOptions($extraOptions)
                )
            );

            if ($response->getCreatedLocation()) {  //  Fetch the created object
                try {
                    $createdResponse = $this->guzzle->get(
                        $response->getCreatedLocation(),
                        $this->prepareOptions()
                    );
                    $response->setEntity($this->entityFromResponse($createdResponse, $resource));
                } catch (RequestException $e) {
                    //  The resource was created (201) but is not readable yet
                    //  (eventual consistency). Keep the success and expose the new
                    //  id parsed from the Location header so callers persist the
                    //  reference instead of orphaning the created resource.
                    if ($resource instanceof GenericResource) {
                        $resource->setId($this->idFromLocation($response->getCreatedLocation()));
                    }
                    $response->setEntity($resource);
                }
            } elseif ($response->getCode() == 204) {    //  Patched OK
                $response->setEntity($resource);
            }

            return $response;
        } catch (RequestException $e) {
            return $this->convertResponse($e->getResponse());
        }
    }

    public function deleteResource(WarehouseResource $resource)
    {
        try {
            return $this->convertResponse(
                $this->guzzle->delete(
                    $resource->getResource(),
                    $this->prepareOptions()
                )
            );
        } catch (RequestException $e) {
            return $this->convertResponse($e->getResponse());
        }
    }

    public function updateRelation(WarehouseRelation $relation)
    {
        try {
            $groups = ['Default', 'update'];
            $updateParameters = $this->serializer->normalize($relation, 'array', [AbstractNormalizer::GROUPS => $groups]);
            $response = $this->convertResponse(
                $this->guzzle->patch(
                    $relation->getResource(),
                    $this->prepareOptions([
                        'json' => $relation->getParameters()
                    ])
                )
            );

            return $response;
        } catch (RequestException $e) {
            return $this->convertResponse($e->getResponse());
        }
    }

    public function deleteRelation(WarehouseRelation $relation)
    {
        try {
            $groups = ['Default', 'delete'];
            $deleteParameters = $this->serializer->normalize($relation, 'array', [AbstractNormalizer::GROUPS => $groups]);
            return $this->convertResponse(
                $this->guzzle->delete(
                    $relation->getResource(),
                    $this->prepareOptions([
                        'json' => $relation->getParameters()
                    ])
                )
            );
        } catch (RequestException $e) {
            return $this->convertResponse($e->getResponse());
        }
    }

    protected function prepareOptions($extraOptions = [])
    {
        if (empty($this->auth))
        {
            throw new AuthMissingException();
        }

        $defaultOptions = [
            'headers' => [
                'Authorization' => '3DWCustomKey ' . base64_encode(implode(':', $this->auth))
            ]
        ];

        $merge = array_merge_recursive($defaultOptions, $extraOptions);

        return $merge;
    }

    /**
     * @param $guzzleResponse
     * @return ApiResponse
     */
    protected function convertResponse(ResponseInterface $guzzleResponse)
    {
        $response = new ApiResponse($guzzleResponse->getStatusCode());
        if ($guzzleResponse->getStatusCode() >= 400) {
            $body = (string)$guzzleResponse->getBody();
            try {
                /** @var ApiResponse $response */
                $response = $this->serializer->deserialize($body, ApiResponse::class, 'json');
            } catch (SerializerExceptionInterface $e) {
                //  The API answered an error status with a non-JSON body (an HTML
                //  gateway page from a 502/503, an empty body, an auth or rate-limit
                //  notice). Surface it as a failed ApiResponse instead of letting the
                //  decode error escape and abort the caller's whole operation.
                $response = new ApiResponse($guzzleResponse->getStatusCode(), false, '', $this->errorBodyExcerpt($body));
            }
            $response->setSuccess(false);
        } elseif ($guzzleResponse->getStatusCode() == 201) {    // Created
            $response->setSuccess(true);
            $createdLocation = $guzzleResponse->getHeader("Location");
            $response->setCreatedLocation(reset($createdLocation));
        } else {
            $response->setSuccess(true);
        }

        return $response;
    }

    /**
     * @param $guzzleResponse
     * @return Result
     */
    protected function convertSearchResult($guzzleResponse)
    {
        $body = (string)$guzzleResponse->getBody();
        try {
            /** @var Result $result */
            $result = $this->serializer->deserialize($body, Result::class, 'json');
            $result->setCode($guzzleResponse->getStatusCode());
        } catch (SerializerExceptionInterface $e) {
            //  Non-JSON body (HTML interstitial, empty, gateway error). Report an
            //  unsuccessful Result rather than throwing.
            $result = new Result();
            $result->setCode($guzzleResponse->getStatusCode());
            $result->setSuccess(false);
            $result->setMessage($this->errorBodyExcerpt($body));
        }
        if ($result->isSuccess()) {
            foreach ($result->getEntries() as $item) {
                switch ($item['class']) {
                    case SubjectClass::COLLECTION:
                        $class = Collection::class;
                        break;
                    case SubjectClass::ENTITY:
                    default:
                        $class = Entity::class;
                        break;
                }

                $entity = $this->serializer->denormalize($item, $class, 'array');
                $result->addItem($entity);
            }
        }

        return $result;
    }

    /**
     * @param $guzzleResponse
     * @param $entity
     * @return object
     */
    protected function entityFromResponse($guzzleResponse, $entity)
    {
        return $this->serializer->deserialize(
            (string)$guzzleResponse->getBody(),
            get_class($entity),
            'json',
            [AbstractNormalizer::GROUPS => ['Default', 'get']]
        );
    }

    private function errorBodyExcerpt($body)
    {
        $body = trim((string) $body);
        if ('' === $body) {
            return 'Empty response body';
        }

        return mb_substr($body, 0, 200);
    }

    private function idFromLocation($location)
    {
        $path = parse_url((string) $location, PHP_URL_PATH);

        return basename(is_string($path) ? $path : (string) $location);
    }

    private function convertToMultipart($data)
    {
        $out = [];
        foreach ($data as $k => $v) {
            $out[] = [
                'name'     => $k,
                'contents' => $v
            ];
        }
        return $out;
    }

    private function convertToFiql($data)
    {
        $phrases = [];
        foreach ($data as $field => $value) {
            $phrases[] = sprintf("%s==%s", $field, is_string($value) ? "\"$value\"" : $value);
        }

        return implode(";", array_filter($phrases));
    }
}
