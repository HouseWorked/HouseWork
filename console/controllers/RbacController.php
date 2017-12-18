<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\components\rbac\UserRoleRule;

class RbacController extends Controller
{

    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll(); //удаляем старые данные

        //Создадим для примера права для доступа к админке
        $dashboard = $auth->createPermission('adminPanel');
        $dashboard->description = 'Админ панель';
        $auth->add($dashboard);

        //Добавляем объект определяющий правила для ролей пользователей, он будет сохранен в файл rules.php
        $rule = new UserRoleRule();
        $auth->add($rule);

        //Добавляем роли
        $user = $auth->createRole('director');
        $user->description = 'Главак';
        $user->ruleName = $rule->name;
        $auth->add($user);

        $moder = $auth->createRole('project_manager');
        $moder->description = 'Проект менеджер';
        $moder->ruleName = $rule->name;
        $auth->add($moder);
        //Добавляем потомков
        $auth->addChild($moder, $user);
        $auth->addChild($moder, $dashboard);

        $admin = $auth->createRole('developer');
        $admin->description = 'Разработчик';
        $admin->ruleName = $rule->name;
        $auth->add($admin);
        $auth->addChild($admin, $moder);
    }

}