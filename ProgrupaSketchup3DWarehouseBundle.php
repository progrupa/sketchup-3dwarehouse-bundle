<?php

namespace Progrupa\Sketchup3DWarehouseBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ProgrupaSketchup3DWarehouseBundle extends Bundle
{
    public function build(ContainerBuilder $builder)
    {
        // No custom compiler passes needed for Symfony Serializer
    }
}
