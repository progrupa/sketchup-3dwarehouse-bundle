<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;

interface Resource
{
    /** @returns string */
    public static function getResource();
    /** @returns string */
    public static function updateResource();
    /** @returns string */
    public static function deleteResource();
    /** @returns array */
    public function attributes();
}
