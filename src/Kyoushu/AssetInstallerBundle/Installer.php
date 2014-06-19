<?php

namespace Kyoushu\AssetInstallerBundle;

class Installer {

    private $assets;

    public function __construct(){
        $this->assets = array();
    }

    /**
     * @param Asset $asset
     * @return $this
     */
    public function addAsset(Asset $asset){
        $this->assets[] = $asset;
        return $this;
    }

    /**
     * @return Asset[]
     */
    public function getAssets(){
        return $this->assets;
    }

    public function install(){
        foreach($this->getAssets() as $asset){
            $asset->install();
        }
    }

} 