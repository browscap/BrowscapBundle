<?php

namespace JoshuaEstes\BrowscapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Joshua Estes <Joshua.Estes@ScenicCityLabs.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('browscap');

        $rootNode
            ->children()
                ->scalarNode('remote_ini_url')
                    ->defaultValue('http://tempdownloads.browserscap.com/stream.php?BrowsCapINI')
                ->end()
                ->scalarNode('remote_ver_url')
                    ->defaultValue('http://tempdownloads.browserscap.com/versions/version-date.php')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
