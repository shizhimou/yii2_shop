<?php
return [
    'defaultRoute'=>'admin/index',
    'language'=>'zh-CN',
    'timeZone'=>'PRC',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager'=>[

            'class'=>'yii\rbac\DbManager',
            'defaultRoles' => ['admin/login','admin/captcha'],
        ]
    ],
];
