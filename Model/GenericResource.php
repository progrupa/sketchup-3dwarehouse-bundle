<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use JMS\Serializer\Annotation\Type;

abstract class GenericResource implements Resource
{
    /**
     * @var string
     * @Type("string")
     */
    protected $id;

    public function __construct($id)
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
        return static::GET .'?id='. $this->getId();
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
    public function attributes()
    {
        return [];
    }
}
