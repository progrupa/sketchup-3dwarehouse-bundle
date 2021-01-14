<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


abstract class GenericRelation implements WarehouseRelation
{
    /**
     * @param Resource $parent
     * @param Resource $child
     * @return self
     */
    public static function fromObjects(WarehouseResource $parent, WarehouseResource $child)
    {
        $class = get_called_class();

        return new $class($parent->getId(), $child->getId(), SubjectClass::pluralFromResource($child));
    }
}
