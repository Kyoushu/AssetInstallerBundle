# KyoushuAssetInstallerBundle

A bundle for copying vendor assets (e.g. images, webfonts) into the web directory.

The master branch is currently a development build, and should not be used for live projects.

## Installation

### AppKernel.php

    // ...
    new Kyoushu\AssetInstallerBundle\KyoushuAssetInstallerBundle(),
    // ...

### config.yml

    # ...

    kyoushu_asset_installer:
        assets:
            jquery:
                input: "%kernel.root_dir%/../vendor/component/jquery/jquery.min.js"
                output: "%kernel.root_dir%/../web/js/jquery.min.js"
            font_awesome:
                input: "%kernel.root_dir%/../vendor/fortawesome/font-awesome/fonts"
                output: "%kernel.root_dir%/../web/fonts"
            open_sans:
                input: "%kernel.root_dir%/../vendor/fontfacekit/open-sans/fonts"
                output: "%kernel.root_dir%/../web/fonts"

    # ...

### Installing Vendor Assets

    app/console kyoushu:install-assets