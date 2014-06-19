<?php

namespace Kyoushu\AssetInstallerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class AssetCompilerPass implements CompilerPassInterface{

    public function process(ContainerBuilder $container){

        $configs = $container->getExtensionConfig('kyoushu_asset_installer');

        $installerDef = $container->getDefinition('kyoushu_asset_installer.installer');
        $assetDefinitions = array();

        foreach($configs as $config){

            foreach($config['assets'] as $assetName => $assetConfig){

                $id = sprintf('kyoushu_asset_installer.asset.%s', $assetName);

                $assetDef = new Definition('Kyoushu\AssetInstallerBundle\Asset');
                $assetDef->setArguments(array(
                    $assetConfig['input'],
                    $assetConfig['output']
                ));

                $assetDefinitions[$id] = $assetDef;

                $installerDef->addMethodCall('addAsset', array(
                    new Reference($id)
                ));

            }

        }

        $container->addDefinitions($assetDefinitions);

    }

} 