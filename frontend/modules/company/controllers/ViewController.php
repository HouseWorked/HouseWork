<?php

namespace frontend\modules\company\controllers;

use app\models\Company;
use yii\web\Controller;

/**
 * Default controller for the `company` module
 */
class ViewController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
		$companies = Company::find()->all();
        return json_encode([
            'status' => 'success',
            'page' => $this->renderAjax('index', [
				'companies' => $companies
			]),
        ]);
    }
}
