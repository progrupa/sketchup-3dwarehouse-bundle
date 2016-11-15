<?php

namespace Progrupa\Sketchup3DWarehouseBundle;

use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Progrupa\Sketchup3DWarehouseBundle\Model\HierarchicalResource;
use Progrupa\Sketchup3DWarehouseBundle\Model\WarehouseRelation;
use Progrupa\Sketchup3DWarehouseBundle\Model\Resource;
use Progrupa\Sketchup3DWarehouseBundle\Model\WarehouseResource;

class Client
{
    const AUTH_RESOURCE = 'authorizewithacs';

    /** @var  \GuzzleHttp\Client */
    private $guzzle;
    /** @var  SerializerInterface */
    private $serializer;

    public function __construct(\GuzzleHttp\Client $guzzle, SerializerInterface $serializer, CookieJar $cookieJar)
    {
        $this->guzzle = $guzzle;
        // @TODO temporary solution, as authentication does not work ATM.
        $cookieJar->setCookie(SetCookie::fromString('SID="AuthKey 23ec5d03-86db-4d80-a378-6059139a7ead"; expires=Thu, 24 Nov 2016 13:52:20 GMT; path=/; domain=.sketchup.com'));
        $this->serializer = $serializer;
    }

    public function getResource(WarehouseResource $entity)
    {
        try {
            $guzzleResponse = $this->guzzle->get($entity->getResource());
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

    public function authenticate()
    {
        try {
            $guzzleResponse = $this->guzzle->post(
                static::AUTH_RESOURCE,
                [
                    'form_params' => [
                        'successUrl' => 'https://modelsdownload.com/pl/',
                        'failureUrl' => 'https://modelsdownload.com/pl/',
                    ]
                ]
            );
            $data = (string) $guzzleResponse->getBody();
        } catch (RequestException $e) {
            return $this->convertResponse($e->getResponse());
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
                    [
                        'form_params' => $parent->addChildParameters($child),
                    ]
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
                    [
                        'multipart' => $this->convertToMultipart($updateParameters),
                    ]
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
                    [
                        'form_params' => [
                            'id' => $resource->getId(),
                        ]
                    ]
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
                    [
                        'multipart' => $this->convertToMultipart($updateParameters),
                    ]
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
                    [
                        'multipart' => $this->convertToMultipart($deleteParameters),
                    ]
                )
            );
        } catch (RequestException $e) {
            return $this->convertResponse($e->getResponse());
        }
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
