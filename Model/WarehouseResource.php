<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;

interface WarehouseResource
{
    /** @return string */
    public function getResource();
    /** @return string */
    public function updateResource();
    /** @return string */
    public function deleteResource();
    /** @return string */
    public function getId();
    /** @return array */
    public function extraAttributes($groups = []);
}
