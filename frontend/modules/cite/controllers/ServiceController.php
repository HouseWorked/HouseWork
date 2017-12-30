<?php
namespace frontend\modules\cite\controllers;

use app\models\Company;
use app\models\Project;
use app\models\ProjectTeem;
use app\models\Task;
use app\models\User;
use app\models\Comment;
use app\models\ErrorProject;
use app\models\Teem;
use app\models\Domains;
use client\modules\domain\models\Domain;
use yii;
use yii\web\Controller;
use yii\helpers\StringHelper;

/**
 * Default controller for the `Cite` module
 */
class ServiceController extends Controller
{
    public function actionMetrica()
    {
		$type = yii::$app->request->post('type');
		$url = yii::$app->request->post('url');
		switch($type){
			case 'yandex':
				return json_encode([
					'status' => 'success',
					'content' => 'yandex',
				]);
				break;
		    case 'google':
				return json_encode([
					'status' => 'success',
					'content' => 'google',
				]);
				break;
			default:
				return json_encode([
					'status' => 'error',
					'content' => 'ПРоверяемый тип не найден',
				]);
				break;
		}
    }
}