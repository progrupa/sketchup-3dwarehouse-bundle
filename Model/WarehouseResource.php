<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;

interface WarehouseResource
{
    /** @return string */
    public function getResource();
    /** @return string */
    public function getId();
    /** @return array */
    public function extraAttributes($groups = []);
}
