<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;

interface Resource
{
    /** @return string */
    public static function getResource();
    /** @return string */
    public static function updateResource();
    /** @return string */
    public static function deleteResource();
    /** @return array */
    public function attributes();
}
