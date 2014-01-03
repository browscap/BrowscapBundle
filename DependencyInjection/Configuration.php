<?php

namespace Browscap\BrowscapBundle\DependencyInjection;

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

        $supportedMethods = array(
            'URL-wrapper',
            'socket',
            'cURL',
            'local',
        );

        $rootNode
            ->children()
                ->scalarNode('cache_dir')
                    ->defaultValue(null)
                ->end()
                ->scalarNode('local_file')
                    ->defaultValue(null)
                ->end()
                ->scalarNode('cache_filename')
                    ->defaultValue('cache.php')
                ->end()
                ->scalarNode('ini_filename')
                    ->defaultValue('browscap.ini')
                ->end()
                ->scalarNode('remote_ini_url')
                    ->defaultValue('http://tempdownloads.browserscap.com/stream.php?BrowsCapINI')
                ->end()
                ->scalarNode('remote_ver_url')
                    ->defaultValue('http://tempdownloads.browserscap.com/versions/version-date.php')
                ->end()
                ->booleanNode('lowercase')
                    ->defaultValue(false)
                ->end()
                ->booleanNode('silent')
                    ->defaultValue(false)
                ->end()
                ->scalarNode('timeout')
                    ->defaultValue(5)
                ->end()
                ->scalarNode('update_interval')
                    ->defaultValue(432000)
                ->end()
                ->scalarNode('error_interval')
                    ->defaultValue(7200)
                ->end()
                ->booleanNode('do_auto_update')
                    ->defaultValue(true)
                ->end()
                ->scalarNode('update_method')
                    ->validate()
                        ->ifNotInArray($supportedMethods)
                        ->thenInvalid('The method "%s" is not supported. Please choose one of ' . json_encode($supportedMethods))
                    ->end()
                    ->cannotBeOverwritten()
                    ->defaultValue('cURL')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
