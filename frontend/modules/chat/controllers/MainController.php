<?php

namespace frontend\modules\chat\controllers;

use yii\web\Controller;

/**
 * Default controller for the `ad` module
 */
class MainController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return json_encode([
            'status' => 'success',
            'page' => $this->renderAjax('index'),
        ]);
    }
}
