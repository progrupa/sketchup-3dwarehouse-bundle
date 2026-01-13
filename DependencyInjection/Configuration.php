<?php

namespace Progrupa\Sketchup3DWarehouseBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('progrupa_sketchup3_d_warehouse');
        $rootNode = method_exists($treeBuilder, 'getRootNode') ? $treeBuilder->getRootNode() : $treeBuilder->root('progrupa_sketchup3_d_warehouse');
        
        $rootNode
            ->children()
                ->scalarNode('base_url')->defaultValue('https://3dwarehouse.sketchup.com:443/warehouse/v1.0/')->end()
                ->scalarNode('authentication_id')->end()
                ->scalarNode('secret')->end()
            ->end();

        return $treeBuilder;
    }
}
