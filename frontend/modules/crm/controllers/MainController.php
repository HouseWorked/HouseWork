<?php

namespace frontend\modules\crm\controllers;

use yii\web\Controller;
use app\models\User;

/**
 * Default controller for the `crm` module
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
	public function actionView($type = "")
    {
		/*switch($type){
			case "test":
				
				break;
			case "":
				break;
			case "":
				break;
			case "":
				break;
			case "":
				break;
		}*/
		$model = new User();
        return json_encode([
            'status' => 'success',
            'content' => $this->renderAjax($type, [
				'model' => $model
			]),
        ]);
    }
}
