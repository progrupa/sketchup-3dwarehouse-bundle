<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use JMS\Serializer\Annotation as Serializer;

abstract class GenericResource implements WarehouseResource
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /** @return string */
    public function getResource()
    {
        return static::GET . ($this->getId() ? sprintf('?id=%s', $this->getId()) : '');
    }

    /** @return string */
    public function updateResource()
    {
        return static::UPDATE .'?id='. $this->getId();
    }

    /** @return string */
    public function deleteResource()
    {
        return static::DELETE .'?id='. $this->getId();
    }

    /** @return array */
    public function extraAttributes($groups = [])
    {
        return [];
    }
}
