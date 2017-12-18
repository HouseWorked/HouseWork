<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/popup/magnific-popup.css',
        'css/popup.css',
        'css/main/main.css',
        'css/main/modal.css',
    ];
    public $js = [
        'js/jquery-2.1.4.min.js',
        'js/popup/jquery.magnific-popup.js',
        'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
        'js/main/screenfull.js',
        'js/main/main.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
