<?php

namespace frontend\modules\cite\controllers;

use yii\web\Controller;
use app\models\Domains;

/**
 * Default controller for the `cite` module
 */
class MainController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
		$model = Domains::find()->all();
		return json_encode([
            'status' => 'success',
            'page' => $this->renderAjax('index', compact('model')),
        ]);
    }
}
