<?php

namespace Progrupa\Sketchup3DWarehouseBundle;

use Progrupa\Sketchup3DWarehouseBundle\DependencyInjection\Compiler\CustomHandlersPass;
use Progrupa\Sketchup3DWarehouseBundle\DependencyInjection\Compiler\RegisterEventListenersAndSubscribersPass;
use Progrupa\Sketchup3DWarehouseBundle\DependencyInjection\Compiler\ServiceMapPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ProgrupaSketchup3DWarehouseBundle extends Bundle
{
    public function build(ContainerBuilder $builder)
    {
        $builder->addCompilerPass(new ServiceMapPass('sketchup_3dwarehouse.serializer.serialization_visitor', 'format',
            function(ContainerBuilder $container, Definition $def) {
                $container->getDefinition('sketchup_3dwarehouse.serializer.serializer')->replaceArgument(3, $def);
            }
        ));
        $builder->addCompilerPass(new ServiceMapPass('sketchup_3dwarehouse.serializer.deserialization_visitor', 'format',
            function(ContainerBuilder $container, Definition $def) {
                $container->getDefinition('sketchup_3dwarehouse.serializer.serializer')->replaceArgument(4, $def);
            }
        ));

        $builder->addCompilerPass(new RegisterEventListenersAndSubscribersPass(), PassConfig::TYPE_BEFORE_REMOVING);
        $builder->addCompilerPass(new CustomHandlersPass(), PassConfig::TYPE_BEFORE_REMOVING);
    }


}
