<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


interface HierarchicalResource
{
    /**
     * @return string
     */
    public function childResource(WarehouseResource $child);

    /**
     * @param Resource $resource
     * @return array
     */
    public function addChildParameters(WarehouseResource $resource);
}
