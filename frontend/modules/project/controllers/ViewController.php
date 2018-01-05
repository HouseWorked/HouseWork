<?php

namespace app\modules\project\controllers;

use app\models\Company;
use app\models\Project;
use app\models\ProjectTeem;
use app\models\Task;
use app\models\User;
use app\models\Comment;
use app\models\ErrorProject;
use app\models\ScreenErrors;
use app\models\Teem;
use app\models\Domains;
use client\modules\domain\models\Domain;
use yii;
use yii\web\Controller;
use yii\helpers\StringHelper;

/**
 * Default controller for the `Project` module
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

    // ОКНА ПОДРОБНОЙ ИНФОРМАЦИИ
    public function actionTask($type = null){ // задачи
        $model = new Task();

        // Массив с исполнителям
        $teem = ProjectTeem::find()->where(['project_id' => yii::$app->request->post('id')])->all();
        foreach ($teem as $index => $item) {
            $performer[] = [
                'id' => $item->user->id,
                'username' => $item->user->username,
                'group' => $item->user->prof->title
            ];
        }
        //Работа с календраем
        if($type !== null){
            switch($type){
                case "add": //Добавления новой задачи
                    $model->title_task = yii::$app->request->post('title');
                    $model->description = yii::$app->request->post('desc');
                    $model->start = yii::$app->request->post('start');
                    $model->ends = yii::$app->request->post('ends');
                    $model->type = yii::$app->request->post('importance');
                    $model->user_id = yii::$app->request->post('performer');
                    $model->creator_id = yii::$app->user->id;
                    $model->project_id = yii::$app->request->post('id');
                    $model->status = 0;
                    $model->save();
                    break;
                case 'send': //Отправка комментария
                    $id = yii::$app->request->post('task_id');
                    $comments = new Comment();
                    $comments->text = yii::$app->request->post('text');
                    $comments->task_id = $id;
                    $comments->creator_id = yii::$app->user->id;
                    $comments->save();
                    $lastNewCommentID = yii::$app->db->lastInsertID;
                    if($comments->save()){
                        $comment = Comment::find()
                            ->where(['id' => $lastNewCommentID])
                            ->andWhere(['task_id' => $id])
                            ->one();
                        return  json_encode([
                            'status' => 'success',
                            'content' => $this->renderAjax('include/modal', [
                                'comments' => $comment,
                                'type' => 'new'
                            ])
                        ]);
                    }
                    break;
                case 'modal': // Добавление в модальное окно комментариев
                    $id = yii::$app->request->post('task_id');
                    $comments = Comment::find()->where(['task_id' => $id])->all();
                    $task = Task::find()->where(['id' => $id])->one();
                    // Массив с исполнителям
                    $teem = ProjectTeem::find()->where(['project_id' => yii::$app->request->post('project_id')])->all();
                    foreach ($teem as $index => $item) {
                        $performers[] = [
                            'id' => $item->user->id,
                            'username' => $item->user->username,
                            'group' => $item->user->prof->title
                        ];
                    }
                    return  json_encode([
                        'status' => 'success',
                        'id' => $id,
                        'content' => $this->renderAjax('include/modal', [
                            'comments' => $comments,
                            'type' => 'all',
                        ]),
                        'contentInfo' =>$this->renderAjax('include/TaskInfoContent', [
                            'task_info' => $task,
                            'performer' => $performers,
                            'model' => $model
                        ])
                    ]);
                    break;
                case 'edit': // Редактирование задачи
                    $id = yii::$app->request->post('id_project');
                    $task = Task::find()->where(['id' => $id])->one();
                    if(yii::$app->request->post('newEnds')){
                        $task->start = yii::$app->request->post('newStart');
                        $task->ends = yii::$app->request->post('newEnds');
                    }else{
                        $task->type = yii::$app->request->post('importance');
                        $task->title_task = yii::$app->request->post('title');
                        $task->description = yii::$app->request->post('desc');
                        $task->user_id = yii::$app->request->post('performer');
                    }
                    $task->save();
                    break;
            }
        }
        // получение задач
        $tasks = Task::find()->where(['project_id' => yii::$app->request->post('id')])->all();
        $events = [];
        foreach ($tasks AS $task){
            $start = date('Y-m-d', strtotime($task->start));
            $ends = date('Y-m-d', strtotime($task->ends));
            $current = date("Y-m-d");
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $task->id;
            $Event->title = $task->title_task;
            $Event->desc = $task->description;
            $Event->type = $task->type; // Добавить при необходимости
            $Event->myDate = $Event->start = date('Y-m-d H:i:s', strtotime($task->ends)); // Добавить при необходимости
            if($task->status == 1){
                $Event->className = 'ok';
            }else{
                $Event->className = ($ends < $current && $task->status == 0)? 'overdue' : $task->type;
            }
            $Event->start = date('Y-m-d H:i:s', strtotime($task->start));
            $Event->end = ($start !== $ends) ? date('Y-m-d H:i:s', strtotime('+1 day', strtotime($task->ends))) : date('Y-m-d H:i:s', strtotime($task->ends));
            $Event->allDay = ($start !== $ends) ? true : false;
            $events[] = $Event;
        }
        return  json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_calendar', [
                'model' => $model,
                'users' => $performer,
                'events' => $events,
                'comments' => $comments,
            ])
        ]);
    }
    public function actionSettings(){
        $modelDomains = Domains::find() // Все свободные домены
            ->where(['project_id' => null])
            ->orWhere(['project_id' => yii::$app->request->post('id')])
            ->all();
        $modelDomainValue = Domains::find() // Домен, закрепленный за проектом
            ->where(['project_id' => yii::$app->request->post('id')])
            ->one();
        $modelMain = Project::find()->where(['id' =>  yii::$app->request->post('id')])->one(); // Данные проекта
        foreach ($modelDomains as $index => $modelDomain) {
            $domains[] = [
                'id' => $modelDomain->id,
                'title' => $modelDomain->title,
            ];
        }
        return  json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_settings', [
                'modelDomains' => $domains,
                'modelMain' => $modelMain,
                'currentDomain' => $modelDomainValue
            ])
        ]);
    }
    public function actionTech(){
        return  json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_tech')
        ]);
    }
    public function actionErrors(){
        $errors = ErrorProject::find()
            ->where(['error_type' => 'design'])
            ->andWhere(['project_id' => yii::$app->request->post('id')])
            ->all();
        return  json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_errors', [
                'errors' => $errors
            ])
        ]);
    }
    public function actionTeem(){	
		// Прикрепление работника к определенному проекту
		$modelProject = new ProjectTeem();
		if(yii::$app->request->post('user_id')){
			$modelProject->project_id = yii::$app->request->post('id');
			$modelProject->user_id    = yii::$app->request->post('user_id');
			$modelProject->insert();
		}
		// Удаление члена команды
		if(yii::$app->request->post('delete_id')){
			$modelDelete = ProjectTeem::find()->where(['user_id' => yii::$app->request->post('delete_id')])->one();
			$modelDelete->delete();
		}
        // Массив с исполнителям
        $model = new User();
        $teem = User::find()->where(['id' => yii::$app->user->id])->one();
        $user = User::find()->where(['teem_id' => $teem->teem->id])->all();
        foreach ($user as $index => $item) {
            $test = ProjectTeem::find()
                ->where(['user_id' => $item->id])
                ->andWhere(['project_id' => yii::$app->request->post('id')])
                ->one();
            if(!$test){
                $performer[] = [
                    'id' => $item->id,
                    'username' => $item->username,
                    'group' => $item->prof->title
                ];
            }
        }

        // Проекты
        $project = ProjectTeem::find()->where(['project_id' => yii::$app->request->post('id')])->all();
        return  json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_teem', [
                'teem_select' => $performer,
                'model' => $model,
                'teems' => $user,
                'projects' => $project
            ])
        ]);
    }

    // AJAX запросы
    public function actionTeemUserInfo(){
        $projects = ProjectTeem::find()
            ->where(['user_id' => yii::$app->request->post('id_user')])
            ->all();
        $user = User::find()
            ->where(['id' => yii::$app->request->post('id_user')])
            ->one();
        return json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('include/modal_info_user', [
                'projects' => $projects,
                'users' => $user
            ])
        ]);
    }
    public function actionErrorsProject(){ // Получение списка ошибок в зависимости от полученного типа задачи
        $errors = ErrorProject::find()
            ->where(['error_type' => yii::$app->request->post('type_errors')])
            ->andWhere(['project_id' => yii::$app->request->post('project_id')])
            ->all();
        return json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('include/content_errors', [
                'errors' => $errors,
            ])
        ]);
    }
    public function actionSaveSettings(){ // Получение списка ошибок в зависимости от полученного типа задачи
        // Сохранение нового имени проекта и основной информации о проекте
        if(yii::$app->formatter->asDate(yii::$app->request->post('new_date_start'), 'Y-M-dd H:i:s') > yii::$app->formatter->asDate(yii::$app->request->post('new_date_ends'), 'Y-M-dd H:i:s')){
            return json_encode([
                'status' => 'error',
                'content' => 'Выбран не правильный диапазон времени'
            ]);
        }
        $project_name = Project::find()->where(['id' => yii::$app->request->post('project_id')])->one();
        $project_name->title = yii::$app->request->post('name_project');
        $project_name->type = yii::$app->request->post('project_type');
        $project_name->date_start = yii::$app->formatter->asDate(yii::$app->request->post('new_date_start'), 'Y-M-dd H:i:s');
        $project_name->date_end = yii::$app->formatter->asDate(yii::$app->request->post('new_date_ends'), 'Y-M-dd H:i:s');
        $project_name->save();
        // Сохранение домена
        $deleteDomainsForProject = Domains::find()->where(['project_id' => yii::$app->request->post('project_id')])->one(); // Отвязываем домен
        $deleteDomainsForProject->project_id = null;
        $deleteDomainsForProject->save();
        $domain = Domains::find()->where(['id' => yii::$app->request->post('domain_id')])->one(); //Привязываем домен
        $domain->project_id = yii::$app->request->post('project_id');
        $domain->save();
        // Сохранение данных о компании и ответственного
        $company = Company::find()->where(['id' => yii::$app->request->post('id_company')])->one();
        $company->title = yii::$app->request->post('name_company');
        $company->firstname = yii::$app->request->post('responsible_name');
        $company->phone = yii::$app->request->post('responsible_phone');
        $company->email = yii::$app->request->post('responsible_email');
        $company->save();
        return json_encode([
            'status' => 'success',
            'content' => 'good'
        ]);
    }
    public function actionModalErrorContent(){
        $screens = ScreenErrors::find()->where(['errors_id' => yii::$app->request->post('error_id')])->all();
        return json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('include/modalContent_for_errors', [
                'screens' => $screens
            ])
        ]);
    }
}