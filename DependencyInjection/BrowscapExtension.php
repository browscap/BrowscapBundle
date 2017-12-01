<?php
declare(strict_types = 1);
namespace Browscap\BrowscapBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Joshua Estes <Joshua.Estes@ScenicCityLabs.com>
 */
class BrowscapExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../resources/config'));
        $loader->load('services.xml');

        if (null === $config['cache_dir']) {
            $config['cache_dir'] = $container->getParameter('kernel.cache_dir');
        }

        foreach ($config as $k => $v) {
            $container->setParameter('browscap.' . $k, $v);
        }
    }
}
