<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'comment' => [
            'class' => 'yii2mod\comments\Module',
        ],
    ],
    'components' => [
        'i18n' => [
            'translations' => [
                'yii2mod.settings' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '/vendor/yii2mod/settings/messages',
                ],
                'yii2mod.comments' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '/vendor/yii2mod/comments/messages',
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'posts/index',
        
                'users/<user_id:\d+>/posts' => 'user-posts/index',
                'users/<user_id:\d+>/posts/<id:\d+>' => 'user-posts/view',
                'users/<user_id:\d+>/posts/<id:\d+>/<_a:[\w-]+>' => 'user-posts/<_a>',
                'users/<user_id:\d+>/posts/<_a:[\w-]+>' => 'user-posts/<_a>',

                '<_c:[\w-]+>' => '<_c>/index',
                '<_c:[\w-]+>/<id:\d+>' => '<_c>/view',
                '<_c:[\w-]+>/<id:\d+>/<_a:[\w-]+>' => '<_c>/<_a>',
            ],
        ],
    ],
    'params' => $params,
];
