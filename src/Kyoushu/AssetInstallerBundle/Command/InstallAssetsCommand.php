<?php

namespace Kyoushu\AssetInstallerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InstallAssetsCommand extends ContainerAwareCommand {

    protected function configure(){
        $this
            ->setName('kyoushu:install-assets')
            ->setDescription('Install vendor assets in web directory')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output){

        $output->writeln('Installing assets');
        $installer = $this->getContainer()->get('kyoushu_asset_installer.installer');

        foreach($installer->getAssets() as $asset){
            $output->writeln(sprintf('     Input Path: <info>%s</info>', $asset->getInputPath()));
            $output->writeln(sprintf('    Output Path: <info>%s</info>', $asset->getOutputPath()));
            $asset->install();
        }

    }

} 