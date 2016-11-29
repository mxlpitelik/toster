<?php
use dektrium\user\controllers\SecurityController;

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'be0pPA6u2EX6NgpdPzJ3ThxdSpXX82Jg',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user'
                ],
            ],
        ],
        'authClientCollection' => [
            'class' => yii\authclient\Collection::className(),
            'clients' => [
                'facebook' => [ //valid for http://local.toster
                    'class'        => 'dektrium\user\clients\Facebook',
                    'clientId'     => '1345447725465366',
                    'clientSecret' => '1995aad35d168e4c9ea7a5971cbb8a51',
                ],
            ],
        ],

        [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'your-email-or-username',
                'password' => 'your-password',
                'port' => '587',
                'encryption' => 'tls',
            ],
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
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            /*   'showScriptName' => false,
               'rules' => [
               ],
            */
        ],

    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin'],

        ],
    ],
    'params' => $params,
];
//
//Event::on(SecurityController::class, SecurityController::EVENT_AFTER_AUTHENTICATE, function (AuthEvent $e) {
//    // if user account was not created we should not continue
//    if ($e->account->user === null) {
//        return;
//    }
//
//    // we are using switch here, because all networks provide different sets of data
//    switch ($e->client->getName()) {
//        case 'facebook':
//            $e->account->user->profile->updateAttributes([
//                'name' => $e->client->getUserAttributes()['name'],
//            ]);
//    }
//
//    // after saving all user attributes will be stored under account model
//    // Yii::$app->identity->user->accounts['facebook']->decodedData
//});

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
