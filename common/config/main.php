<?php

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => yii\caching\FileCache::class,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'landing' => 'landing/index',
                'logout' => 'site/logout',
                'tasks' => 'tasks/index',
                'tasks/view/<id:\d+>' => 'tasks/get-view',
                'tasks/view/<id:\d+>/response-accept/<responseId:\d+>' => 'tasks/response-accept',
                'tasks/view/<id:\d+>/response-refuse/<responseId:\d+>' => 'tasks/response-refuse',
                'users' => 'users/index',
                'users/view/<id:\d+>' => 'users/get-view',
                'registration' => 'registration/index',
                'create' => 'create/index',
            ],
        ],
        'user' => [
            'class' => '\yii\web\User',
            'loginUrl' => ['landing'],
        ],
    ],
];
