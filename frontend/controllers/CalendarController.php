<?php
namespace frontend\controllers;

use frontend\models\Task;
use Yii;
use yii\web\Controller;


/**
 * Site controller
 */
class CalendarController extends Controller
{
    public function actionSource(){
        $type = $_POST['type'];
        $id = $_SESSION['id']; // creator id

        $result = Task::find()->all();
        foreach($result as $key => $task){
            $json[] = [
                'id' => $task->id,
                'title' => $task->title,
                'desc' => $task->descripton,
                'start' => $task->start,
                'end' => $task->ends,
//                        'className' => ($task['ends'] < date('Y-m-d H:i:s', time())) ? 'overdue' : "",
                'className' => 'overdue',
                'backgroundColor' => $task->type,
//                        'creator' => $creator[5]." ".$creator[4],
//                        'creat_at' => $task['creat_at'],
//                        'user' => $task['user_id'],
                'allDay' => false,
            ];
        }
        return json_encode($json);


    }
}
