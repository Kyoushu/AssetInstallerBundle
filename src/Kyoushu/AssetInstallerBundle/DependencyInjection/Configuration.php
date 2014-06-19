<?php

namespace Kyoushu\AssetInstallerBundle\DependencyInjection;

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
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kyoushu_asset_installer');

        /* @var $assetsNode \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition */
        $assetsNode = $rootNode->children()->arrayNode('assets')->isRequired()->prototype('array');

        $assetsNode->children()->scalarNode('input')->isRequired();
        $assetsNode->children()->scalarNode('output')->isRequired();

        return $treeBuilder;
    }
}
