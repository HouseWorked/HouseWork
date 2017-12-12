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
        'css/project/main.css'
    ];
    public $js = [
        'js/project/main.js',
        'js/project/calendar.js',
    ];
    public $depends = [

    ];
}
