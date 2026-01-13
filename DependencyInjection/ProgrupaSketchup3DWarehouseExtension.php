<?php

namespace Progrupa\Sketchup3DWarehouseBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ProgrupaSketchup3DWarehouseExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('progrupa.sketchup_3dwarehouse.base_url', $config['base_url']);
        $container->setParameter('progrupa.sketchup_3dwarehouse.authentication_id', $config['authentication_id']);
        $container->setParameter('progrupa.sketchup_3dwarehouse.secret', $config['secret']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('services.symfony_serializer.yml');
    }
}
