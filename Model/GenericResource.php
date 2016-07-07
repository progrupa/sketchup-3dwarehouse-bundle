<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


abstract class GenericResource implements Resource
{
    /** @returns string */
    public static function getResource()
    {
        return static::GET;
    }

    /** @returns string */
    public static function updateResource()
    {
        return static::UPDATE;
    }

    /** @returns string */
    public static function deleteResource()
    {
        return static::DELETE;
    }

}
