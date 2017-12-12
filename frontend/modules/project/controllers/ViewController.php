<?php

namespace app\modules\project\controllers;

use app\models\Project;
use app\models\Task;
use app\models\User;
use app\models\Comment;
use app\models\Teem;
use yii;
use yii\web\Controller;
use yii\helpers\StringHelper;

/**
 * Default controller for the `Project` module
 */
class ViewController extends Controller
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

    // ОКНА ПОДРОБНОЙ ИНФОРМАЦИИ
    public function actionTask($type = null){ // задачи
        $model = new Task();
        $teem = User::find()->where(['id' => yii::$app->user->id])->one();
        $user = User::find()->where(['teem_id' => $teem->teem->id])->all();

        // Массив с исполнителям
        foreach ($user as $index => $item) {
            $performer[] = [
                'id' => $item->id,
                'username' => $item->username,
                'group' => $item->prof->title
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
                    $comments = Comment::find()->where(['task_id' => yii::$app->request->post('task_id')])->all();
                    return  json_encode([
                        'status' => 'success',
                        'content' => $this->renderAjax('include/modal', [
                            'comments' => $comments,
                            'type' => 'all'
                        ])
                    ]);

                    break;
            }
        }
        // получение задач
        $tasks = Task::find()->all();
        $events = [];
        foreach ($tasks AS $task){

            $start = date('Y-m-d', strtotime($task->start));
            $ends = date('Y-m-d', strtotime($task->ends));
            $current = date("Y-m-d");
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $task->id;
            $Event->title = $task->title_task;
            $Event->desc = $task->description;
            if($task->status == 1){
                $Event->className = 'ok';
            }else{
                $Event->className = ($start < $current && $task->status == 0)? 'overdue' : $task->type;
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
        return  json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_settings')
        ]);
    }
    public function actionTech(){
        return  json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_tech')
        ]);
    }
    public function actionTeem(){
        return  json_encode([
            'status' => 'success',
            'content' => $this->renderAjax('_teem')
        ]);
    }
}