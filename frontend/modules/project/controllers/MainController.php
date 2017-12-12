<?php

namespace app\modules\project\controllers;

use yii;
use yii\web\Controller;
use app\models\Project;
use yii\helpers\StringHelper;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `Project` module
 */
class MainController extends Controller
{
    public function actionIndex()
    {
        return json_encode([
            'status' => 'success',
            'page' => $this->renderAjax('index'),
        ]);
    }
    public function actionView($type = ''){
        $projects = Project::find()->limit(20)->where(['type' => $type])->all();

        return json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_project', compact('projects')),
            'type' => $type
        ]);
    }
    public function actionProjectSearch($search = ''){
        if ($search !== '' ) {
            $projects = Project::find()
                ->Where(['like', 'title', $search])
                ->andWhere(['type' => yii::$app->request->post('type')])
                ->orWhere(['like', 'title', StringHelper::invert($search)])
                ->all();
        }else{
            $projects = Project::find()->where(['type' => yii::$app->request->post('type')])->all();
        }
        return json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_project-item', compact('projects'))
        ]);

    }


}