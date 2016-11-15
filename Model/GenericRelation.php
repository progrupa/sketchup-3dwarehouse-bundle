<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


class GenericRelation implements WarehouseRelation
{
    /** @return string */
    public function updateResource()
    {
        return static::UPDATE;
    }

    /** @return string */
    public function deleteResource()
    {
        return static::DELETE;
    }

    /**
     * @param Resource $parent
     * @param Resource $child
     * @return self
     */
    public static function fromObjects(WarehouseResource $parent, WarehouseResource $child)
    {
        $class = get_called_class();

        return new $class($parent->getId(), $child->getId(), SubjectClass::fromResource($child));
    }
}
