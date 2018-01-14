<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use app\models\Task;
use app\models\ErrorProject;
use app\models\ProjectTeem;
use yii\web\YiiAsset;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [
                            'logout',
                            'index'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
		$task = Task::find()->where(['user_id' => yii::$app->user->id])->all();
		$project_user = ProjectTeem::find()->where(['user_id' => yii::$app->user->id])->all();
		$error_container = [];
		foreach($project_user as $user){
			switch($user->user->prof->title){
				case "Программист":
					$proff = 'programming';
					break;
				case "Дизайнер":
					$proff = 'design';
					break;
			}
			$errors = ErrorProject::find()
				->where(['project_id' => $user->project_id])
				->andWhere(['error_type' => $proff])
				->all();
			foreach($errors as $error){
				$error_container[] = [
					'id' => $error->id,
					'title' => $error->title
				];
			}
		}
        if (!Yii::$app->user->isGuest) {
            return $this->render('index', [
				'tasks' => $task,
				'errors' => $error_container
			]);
        }else{
            return $this->redirect(['/login/index']);
        }
    }
}
