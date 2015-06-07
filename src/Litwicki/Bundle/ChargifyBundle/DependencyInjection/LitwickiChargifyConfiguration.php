<?php

namespace Litwicki\Bundle\ChargifyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class LitwickiChargifyConfiguration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('litwicki_chargify');

        $rootNode
            ->children()
                ->booleanNode('test_mode')->defaultValue('%kernel.debug%')->end()
                ->scalarNode('api_key')->defaultValue('~')->end()
                ->scalarNode('shared_key')->defaultFalse()->end()
                ->scalarNode('domain')->defaultValue('~')->end()
                ->scalarNode('data_format')->defaultValue('json')->end()
                ->scalarNode('route_prefix')->defaultValue('/chargify')->end()
                ->arrayNode('direct')
                    ->children()
                        ->scalarNode('api_id')->defaultValue('~')->end()
                        ->scalarNode('api_secret')->defaultValue('~')->end()
                        ->scalarNode('api_password')->defaultValue('~')->end()
                    ->end()
                ->end()

            ->end()
        ;

        return $treeBuilder;
    }
}
