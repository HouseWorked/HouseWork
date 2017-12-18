<?php
namespace common\components\rbac;

use Yii;
use yii\rbac\Rule;
use yii\helpers\ArrayHelper;
use common\models\User;

/*
 * Создаем класс правил.
 * Сравнивается роль текущего пользователя с ролью, которая необходима для получения доступа
 */
class UserRoleRule extends Rule
{
    public $name = 'userRole'; //название данного правила
    /*
     * $user - id текущего пользователя
     * $item - объект роли которую проверяем у текущего пользователя
     * $params - параметры, которые можно передать для проведеня проверки в данный класс
     */
    public function execute($user, $item, $params)
    {
        //Получаем объект текущего пользователя из базы
        $user = ArrayHelper::getValue($params, 'user', User::findOne($user));

        if ($user) {
            $role = $user->role_id;

            if ($item->name === 'director') {
                return $role == User::ROLE_ADMIN;
            }
            elseif ($item->name === 'project_manager') {
                return $role == User::ROLE_ADMIN || $role == User::ROLE_MODER;
            }
            elseif ($item->name === 'developer') {
                return $role == User::ROLE_ADMIN || $role == User::ROLE_MODER
                    || $role == User::ROLE_USER;
            }
        }

        return false;
    }
}