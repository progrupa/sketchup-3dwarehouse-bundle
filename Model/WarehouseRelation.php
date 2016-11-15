<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


interface WarehouseRelation
{
    /** @return string */
    public function updateResource();
    /** @return string */
    public function deleteResource();
}
