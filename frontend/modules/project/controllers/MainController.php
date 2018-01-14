<?php

namespace app\modules\project\controllers;

use app\models\Company;
use yii;
use yii\web\Controller;
use app\models\Project;
use app\models\Menu;
use app\models\User;
use yii\helpers\StringHelper;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `Project` module
 */
class MainController extends Controller
{
    public function actionIndex()
    {
        $menu = Menu::find()->where(['status' => '1'])->all();
        return json_encode([
            'status' => 'success',
            'page' => $this->renderAjax('index', [
                'menu' => $menu
            ]),
        ]);
    }
    public function actionView($type = ''){
        $model = new Project();
        if($model->load(yii::$app->request->post(), '') && $model->validate()){
            if(!$model->save()){
                return json_encode([
                    'status' => 'fail',
                    'content' => 'Ошибка сохранения'
                ]);
            }
        }
        $projects = Project::find()->limit(20)->where(['type' => $type])->all();
        $companies = Company::find()->all();
        $users = User::find()
            ->where(['role_id' => 'project_manager'])
            ->orWhere(['role_id' => 'director'])
            ->all();

        return json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_project', compact('projects', 'model', 'users', 'companies')),
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
    public function actionNewProject(){
        $model = new Project();
        $projects = Project::find()->limit(20)->where(['type' => $type])->all();
        $companies = Company::find()->all();
        $users = User::find()
            ->where(['role_id' => 'project_manager'])
            ->orWhere(['role_id' => 'director'])
            ->all();

        return json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_project', compact('projects', 'model', 'users', 'companies')),
            'type' => $type
        ]);
    }


}