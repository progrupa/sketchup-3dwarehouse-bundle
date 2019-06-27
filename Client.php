<?php

namespace Progrupa\Sketchup3DWarehouseBundle;

use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Progrupa\Sketchup3DWarehouseBundle\Model\Collection;
use Progrupa\Sketchup3DWarehouseBundle\Model\Entity;
use Progrupa\Sketchup3DWarehouseBundle\Model\HierarchicalResource;
use Progrupa\Sketchup3DWarehouseBundle\Model\WarehouseRelation;
use Progrupa\Sketchup3DWarehouseBundle\Model\Resource;
use Progrupa\Sketchup3DWarehouseBundle\Model\WarehouseResource;
use Progrupa\Sketchup3DWarehouseBundle\Search\Query;
use Progrupa\Sketchup3DWarehouseBundle\Search\Result;

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

            $response->setEntity(
                $this->serializer->deserialize(
                    (string)$guzzleResponse->getBody(),
                    get_class($entity),
                    'json',
                    DeserializationContext::create()->setGroups(['Default', 'get'])
                )
            );

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
            $extraOptions = $this->serializer->serialize($query, 'array');
            $guzzleResponse = $this->guzzle->get(
                'search',
                $this->prepareOptions(
                    ['query' => $extraOptions]
                )
            );

            $response = $this->convertSearchResult($guzzleResponse);

            return $response;
        } catch (RequestException $e) {
            return $this->convertSearchResult($e->getResponse());
        }
    }

    /**
     * @param HierarchicalResource $parent
     * @param Resource $child
     * @return ApiResponse
     */
    public function assignChild(HierarchicalResource $parent, WarehouseResource $child)
    {
        try {
            return $this->convertResponse(
                $this->guzzle->post(
                    $parent->addChildResource(),
                    $this->prepareOptions([
                        'form_params' => $parent->addChildParameters($child),
                    ])
                )
            );
        } catch (RequestException $e) {
            return $this->convertResponse($e->getResponse());
        }
    }

    public function updateResource(WarehouseResource $resource)
    {
        try {
            $groups = ['Default', 'update'];
            $updateParameters = array_merge(
                $this->serializer->serialize($resource, 'array', SerializationContext::create()->setGroups($groups)),
                $resource->extraAttributes($groups)
            );
            $response = $this->convertResponse(
                $this->guzzle->post(
                    $resource->updateResource(),
                    $this->prepareOptions([
                        'multipart' => $this->convertToMultipart($updateParameters),
                    ])
                )
            );
            if ($response->getId()) {
                $resource->setId($response->getId());
            }
            $response->setEntity($resource);

            return $response;
        } catch (RequestException $e) {
            return $this->convertResponse($e->getResponse());
        }
    }

    public function deleteResource(WarehouseResource $resource)
    {
        try {
            return $this->convertResponse(
                $this->guzzle->post(
                    $resource->deleteResource(),
                    $this->prepareOptions([
                        'form_params' => [
                            'id' => $resource->getId(),
                        ]
                    ])
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
            $updateParameters = $this->serializer->serialize($relation, 'array', SerializationContext::create()->setGroups($groups));
            $response = $this->convertResponse(
                $this->guzzle->post(
                    $relation->updateResource(),
                    $this->prepareOptions([
                        'multipart' => $this->convertToMultipart($updateParameters),
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
            $deleteParameters = $this->serializer->serialize($relation, 'array', SerializationContext::create()->setGroups($groups));
            return $this->convertResponse(
                $this->guzzle->post(
                    $relation->deleteResource(),
                    $this->prepareOptions([
                        'multipart' => $this->convertToMultipart($deleteParameters),
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
    protected function convertResponse($guzzleResponse)
    {
        /** @var ApiResponse $response */
        $body = (string)$guzzleResponse->getBody();
        $response = $this->serializer->deserialize($body, ApiResponse::class, 'json');
        $response->setCode($guzzleResponse->getStatusCode());

        return $response;
    }

    /**
     * @param $guzzleResponse
     * @return Result
     */
    protected function convertSearchResult($guzzleResponse)
    {
        $body = (string)$guzzleResponse->getBody();
        /** @var Result $result */
        $result = $this->serializer->deserialize($body, Result::class, 'json');
        if ($result->isSuccess()) {
            foreach ($result->getEntries() as $item) {
                switch ($item['class']) {
                    case Query::CLASS_COLLECTION:
                        $class = Collection::class;
                        break;
                    case Query::CLASS_ENTITY:
                    default:
                        $class = Entity::class;
                        break;
                }

                $entity = $this->serializer->deserialize($item, $class, 'array');
                $result->addItem($entity);
            }
        }
        $result->setCode($guzzleResponse->getStatusCode());

        return $result;
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
}
