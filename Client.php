<?php

namespace Progrupa\Sketchup3DWarehouseBundle;

use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\SerializerInterface;
use Progrupa\Sketchup3DWarehouseBundle\Model\HierarchicalResource;
use Progrupa\Sketchup3DWarehouseBundle\Model\Resource;

class Client
{
    const AUTH_RESOURCE = 'authorizewithacs';

    /** @var  \GuzzleHttp\Client */
    private $guzzle;
    /** @var  SerializerInterface */
    private $serializer;

    public function __construct(\GuzzleHttp\Client $guzzle, SerializerInterface $serializer)
    {
        $this->guzzle = $guzzle;
        $this->serializer = $serializer;
    }

    public function getResource(Resource $entity)
    {
        try {
            $guzzleResponse = $this->guzzle->get($entity->getResource());
            $response = $this->convertResponse($guzzleResponse);

            $response->setEntity($this->serializer->deserialize((string)$guzzleResponse->getBody(), get_class($entity), 'json'));

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
    public function assignChild(HierarchicalResource $parent, Resource $child)
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

    public function updateResource(Resource $resource)
    {
        try {
            return $this->convertResponse(
                $this->guzzle->post(
                    $resource->updateResource(),
                    [
                        'form_params' => $resource->attributes()
                    ]
                )
            );
        } catch (RequestException $e) {
            return $this->convertResponse($e->getResponse());
        }
    }

    public function deleteResource(Resource $resource)
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

    /**
     * @param $guzzleResponse
     * @return ApiResponse
     */
    protected function convertResponse($guzzleResponse)
    {
        /** @var ApiResponse $response */
        $response = $this->serializer->deserialize((string)$guzzleResponse->getBody(), ApiResponse::class, 'json');
        $response->setCode($guzzleResponse->getStatusCode());

        return $response;
    }
}
