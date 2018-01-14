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
        'css/project/project.css',
        '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css',

    ];
    public $js = [
        '//cdn.jsdelivr.net/momentjs/latest/moment.min.js',
        '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js',
        'js/project/main.js',
        'js/project/calendar.js',
        'js/project/settings.js',
        'js/project/errors.js',
        'js/project/teem.js'
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
