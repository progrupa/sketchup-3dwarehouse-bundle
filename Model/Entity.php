<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use JMS\Serializer\Annotation\Type;

class Entity extends GenericResource
{
    const GET = 'warehouse/getentity';
    const UPDATE = 'warehouse/setentity';
    const DELETE = 'warehouse/deleteentity';

    /**
     * @var string
     * @Type("string")
     */
    private $id;

    /** @returns array */
    public function attributes()
    {
        return [
            'id' => $this->id,
        ];
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
