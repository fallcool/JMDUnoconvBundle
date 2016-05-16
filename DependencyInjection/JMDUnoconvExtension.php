<?php

namespace JMD\UnoconvBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class JMDUnoconvExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (!isset($config['config'])) {
            $config['config'] = [
                'timeout'   => 42,
                'binaries'  => '/usr/bin/unoconv',
            ];
        }

        if (isset($config['config']['binaries'])) {
            $config['config']['unoconv.binaries'] = $config['config']['binaries'];
            unset($config['config']['binaries']);
        }

        $container->setParameter('jmd_unoconv.config', $config['config']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
