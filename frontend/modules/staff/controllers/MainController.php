<?php

namespace frontend\modules\staff\controllers;

use yii\web\Controller;

/**
 * Default controller for the `staff` module
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
