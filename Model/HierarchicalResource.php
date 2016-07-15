<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


interface HierarchicalResource
{
    /**
     * @return string
     */
    public function addChildResource();

    /**
     * @param Resource $resource
     * @return array
     */
    public function addChildParameters(Resource $resource);
}
