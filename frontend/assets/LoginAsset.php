<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css',
        'css/style.default.css'
    ];
    public $js = [
        'https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js',
        'js/login/jquery.cookie.js',
        'js/login/jquery.validate.min.js',
        'js/login/login.js',
    ];
    public $depends = [

    ];
}
