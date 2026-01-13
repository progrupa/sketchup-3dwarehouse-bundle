<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;

interface BinaryContainingResource
{
    /**
     * Return resource path for binaries manipulation
     * @param string $name
     */
    public function binariesResource($name = null);
}