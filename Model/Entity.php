<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use JMS\Serializer\Annotation\Type;

class Entity extends GenericResource
{
    const GET = '/warehouse/getentity';
    const UPDATE = '/warehouse/setentity';
    const DELETE = '/warehouse/deleteentity';

    /**
     * @Type("string")
     */
    private $id;
    /**
     * @Type("boolean")
     */
    private $isHidden;
    /**
     * @Type("integer")
     */
    private $commentCount;
    /**
     * @Type("boolean")
     */
    private $allowComments;
    /**
     * @Type("string")
     */
    private $createTime;
    /**
     * @Type("string")
     */
    private $parentCatalogId;
    /**
     * @Type("boolean")
     */
    private $success;
    /**
     * @Type("array")
     */
    private $attributes;
    /**
     * @Type("array")
     */
    private $location;
    /**
     * @Type("array")
     */
    private $binaries;


    /** @return array */
    public function attributes()
    {
        return [
            'id' => $this->id,
        ];
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
    public function getId()
    {
        return $this->id;
    }


}
