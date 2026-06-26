<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;

use Symfony\Component\Serializer\Attribute\Groups;

abstract class GenericResource implements WarehouseResource
{
    #[Groups(['get'])]
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
        return static::RESOURCE . ($this->getId() ? sprintf('/%s', $this->getId()) : '');
    }

    /** @return array */
    public function extraAttributes($groups = [])
    {
        return [];
    }
}
