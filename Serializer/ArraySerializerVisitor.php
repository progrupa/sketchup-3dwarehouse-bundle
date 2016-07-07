<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Serializer;


use JMS\Serializer\GenericSerializationVisitor;
use JMS\Serializer\scalar;

class ArraySerializerVisitor extends GenericSerializationVisitor
{
    /**
     * @return array
     */
    public function getResult()
    {
        return $this->getRoot();
    }

}
