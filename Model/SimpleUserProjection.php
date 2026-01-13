<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;

class SimpleUserProjection
{
    /**
     * @var string

     */
    private $id;
    /**
     * @var string

     */
    private $displayName;

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

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }
}
