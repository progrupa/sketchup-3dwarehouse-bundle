<?php

namespace Progrupa\Sketchup3DWarehouseBundle;

use JMS\Serializer\SerializerInterface;
use Progrupa\Sketchup3DWarehouseBundle\Model\Resource;

class Client
{
    /** @var  \GuzzleHttp\Client */
    private $guzzle;
    /** @var  SerializerInterface */
    private $serializer;

    public function __construct($guzzle, $serializer)
    {
        $this->guzzle = $guzzle;
        $this->serializer = $serializer;
    }

    public function getResource($resourceClass, $id)
    {
        $endpoint = $resourceClass::getResource();

        $entity = new $resourceClass;
        $entity->setId($id);

        $response = $this->guzzle->get($endpoint .'?'. http_build_query($entity->attributes()));
        $entity = $this->serializer->deserialize((string) $response->getBody(), $resourceClass, 'json');

        return $entity;
    }

    public function updateResource(Resource $resource)
    {

    }

    public function deleteResource(Resource $resource)
    {

    }
}
