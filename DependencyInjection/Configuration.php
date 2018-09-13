<?php

namespace Happyr\WordpressBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle.
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $root = $treeBuilder->root('wordpress');

        $root->children()
            ->scalarNode('url')->cannotBeEmpty()->isRequired()->end()
            ->arrayNode('cache')
                ->children()
                    ->scalarNode('service')->cannotBeEmpty()->isRequired()->end()
                    ->integerNode('ttl')->defaultValue(3600)->end()
                ->end()
            ->end()
            ->arrayNode('controller')
                ->canBeDisabled()
                ->children()
                    ->scalarNode('index_template')->defaultValue('@Wordpress/index.html.twig')->end()
                    ->scalarNode('page_template')->defaultValue('@Wordpress/page.html.twig')->end()
                ->end()
        ->end();

        return $treeBuilder;
    }
}
