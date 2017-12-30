<?php

namespace frontend\modules\fin\controllers;

use yii\web\Controller;

/**
 * Default controller for the `fin` module
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
