<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CrmAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/crm/crm.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
