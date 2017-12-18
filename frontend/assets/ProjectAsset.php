<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ProjectAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css',
        'css/project/main.css'
    ];
    public $js = [
//        'js/jquery-2.1.4.min.js',
        '//cdn.jsdelivr.net/momentjs/latest/moment.min.js',
        '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js',
        'js/project/main.js',
        'js/project/calendar.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
