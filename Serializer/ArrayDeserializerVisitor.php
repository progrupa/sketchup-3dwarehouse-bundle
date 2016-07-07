<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Serializer;


use JMS\Serializer\GenericDeserializationVisitor;

class ArrayDeserializerVisitor extends GenericDeserializationVisitor
{
    /**
     * @param array $data
     * @return array
     */
    protected function decode($data)
    {
        return $data;
    }
}
