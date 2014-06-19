<?php

namespace Kyoushu\AssetInstallerBundle;

use Kyoushu\AssetInstallerBundle\DependencyInjection\Compiler\AssetCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class KyoushuAssetInstallerBundle extends Bundle
{

    public function build(ContainerBuilder $container){
        parent::build($container);
        $container->addCompilerPass( new AssetCompilerPass() );
    }

}
