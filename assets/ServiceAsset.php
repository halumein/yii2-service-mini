<?php
namespace halumein\servicemini\assets;

use yii\web\AssetBundle;

class ServiceAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $js = [
        'js/tariff_grid.js',
    ];

    public $css = [
        'css/styles.css',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/../web';
        parent::init();
    }
}