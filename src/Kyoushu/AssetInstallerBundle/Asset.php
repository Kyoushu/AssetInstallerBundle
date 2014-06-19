<?php

namespace Kyoushu\AssetInstallerBundle;

use Kyoushu\AssetInstallerBundle\Exception\AssetException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class Asset {

    private $inputPath;
    private $outputPath;

    /**
     * @param string $inputPath
     * @param string $outputPath
     */
    public function __construct($inputPath, $outputPath){
        $this->inputPath = $inputPath;
        $this->outputPath = $outputPath;

        $this->validate();
    }

    private function validate(){

        if(!file_exists($this->inputPath)){
            throw new AssetException(sprintf(
                'The asset "%s" does not exist',
                $this->inputPath
            ));
        }

    }

    /**
     * @return string
     */
    public function getInputPath(){
        return $this->inputPath;
    }

    /**
     * @return string
     */
    public function getOutputPath(){
        return $this->outputPath;
    }

    public function isDir(){
        return is_dir($this->getInputPath());
    }

    public function install(){

        $fs = new Filesystem();

        if($this->isDir()){

            $finder = new Finder();
            $finder->in($this->getInputPath())->files();

            $relPathRegex = sprintf('/^%s/', preg_quote($this->getInputPath(), '/'));

            foreach($finder as $file){
                /* @var $file \Symfony\Component\Finder\SplFileInfo */

                $inputPath = (string)$file;
                $relPath = preg_replace($relPathRegex, '', $inputPath);
                $outputPath = $this->getOutputPath() . $relPath;

                $fs->copy($inputPath, $outputPath, true);
                $fs->chmod($outputPath, 0644);
            }

        }
        else{
            $fs->copy($this->getInputPath(), $this->getOutputPath());
            $fs->chmod($this->getOutputPath(), 0644);
        }



    }

} 