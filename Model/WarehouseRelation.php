<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;

interface WarehouseRelation
{
    /** @return string */
    public function getResource();
    /** @return array */
    public function getParameters();
}
