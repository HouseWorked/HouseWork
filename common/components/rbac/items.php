<?php
return [
    'adminPanel' => [
        'type' => 2,
        'description' => 'Админ панель',
    ],
    'director' => [
        'type' => 1,
        'description' => 'Главак',
        'ruleName' => 'userRole',
    ],
    'project_manager' => [
        'type' => 1,
        'description' => 'Проект менеджер',
        'ruleName' => 'userRole',
        'children' => [
            'director',
            'adminPanel',
        ],
    ],
    'developer' => [
        'type' => 1,
        'description' => 'Разработчик',
        'ruleName' => 'userRole',
        'children' => [
            'project_manager',
        ],
    ],
];
