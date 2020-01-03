<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'CEU-CC',
    'name' => 'CEU-CC',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Manila',
    'components' => [
       
        'assetManager' => [
            'linkAssets' => true,
        ],
        
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'PEi6ICsok3vWiJSJJtQV2JZ6D-jk5gkh',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /*'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],*/
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

        //if you want to login your user using gmail
        /*'authClientCollection' => [
            'class' => yii\authclient\Collection::className(),
            'clients' => [
                'google' => [
                    'class'        => 'dektrium\user\clients\Google',
                    'clientId'     => '1098520721785-l5r997r9ib2vt986mlqplvtmg1r7ue4l.apps.googleusercontent.com',
                    'clientSecret' => '1m5BN2MuZhQvbaVI3yaQKVRK',
                    'returnUrl'=>'http://localhost/ceuportal/web/user/security/auth?authclient=google',
                ],
            ],
        ],*/

        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views/security' => '@app/views/admin-user',
                    '@dektrium/user/views/admin' => '@app/views/admin',
                ],
            ],
        ],
        
    ],
    'aliases' => [
        '@adminlte/widgets'=>'@vendor/adminlte/yii2-widgets'
        ],
    'params' => $params,

    'modules' => [

        'gridview' => ['class' => 'kartik\grid\Module'],

        'user' => [
            'class' => 'dektrium\user\Module',
            'enableFlashMessages' => true,
            'enableConfirmation' => false,
            'enableUnconfirmedLogin' => true,
            'enableRegistration' => false,
            'adminPermission' => 'administrator',
            'admins' => ['admin'],

            'modelMap' => [

                'Profile' => 'app\models\Profile',
             ],

            'controllerMap' => [
                'admin' => 'app\controllers\AdminController',
                'security' => [
                    'class' => \dektrium\user\controllers\SecurityController::className(),
                    'layout' => '@app/views/layouts/login_layout',
                ],
            ],

        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'mainLayout' => '@app/views/layouts/main.php',
            'layout' => 'top-menu', 
            
        ]
    ],

    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //'site/index',
            //'admin/*',
            //'user/*'
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
