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
class ViewController extends Controller
{
    public function actionIndex($id)
    {
        return json_encode([
            'status' => 'success',
            'page' => $this->renderAjax('index', compact('id')),
        ]);
    }
	public function actionInfo(){
		$domain = Domains::find()->where(['id' => yii::$app->request->post('id')])->one();
		return json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_info', [
				'domain' => $domain
			]),
        ]);
	}
	public function actionProject(){
		$project = Domains::find()->where(['id' => yii::$app->request->post('id')])->one();
		$projectTeems = ProjectTeem::find()->where(['project_id' => $project->project_id])->all();
		return json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_project', [
				'project' => $project,
				'teems' => $projectTeems
			]),
        ]);
	}
	public function actionStatics(){
		return json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_statics'),
        ]);
	}
}