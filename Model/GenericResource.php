<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


abstract class GenericResource implements Resource
{
    /** @return string */
    public static function getResource()
    {
        return static::GET;
    }

    /** @return string */
    public static function updateResource()
    {
        return static::UPDATE;
    }

    /** @return string */
    public static function deleteResource()
    {
        return static::DELETE;
    }

}
