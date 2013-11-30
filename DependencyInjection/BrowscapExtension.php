<?php

namespace Browscap\BrowscapBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

use Symfony\Component\Form\Exception\InvalidConfigurationException;

/**
 * @author Joshua Estes <Joshua.Estes@ScenicCityLabs.com>
 */
class BrowscapExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if( $config['cache_dir'] === null ) {
            $config['cache_dir'] = $container->getParameter('kernel.cache_dir');
        }

        foreach ($config as $k => $v) {
            $container->setParameter('browscap.' . $k, $v);
        }
    }
}
