<?php
$rootDir = __DIR__ . '/../..';

$params = array_merge(
    require($rootDir . '/common/config/params.php'),
    require($rootDir . '/common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return array(
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => [
                '192.168.56.1'
            ],
            'generators' => [
                'model' => [
                    'class' => 'yii\gii\generators\model\Generator',
                    'ns' => 'common\models\generated',
                    'baseClass' => '\common\components\ActiveRecord',
                    'generateLabelsFromComments' => true
                ]
            ]
        ],
    ],
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
    'components' => [
        'db' => $params['components.db'],
        'text' => $params['components.text'],
        'sphinxDb' => $params['components.sphinxDb'],
        'cache' => $params['components.cache'],
        'mail' => $params['components.mail'],
        'user' => [
            'identityClass' => 'common\models\User',
        ],
        'assetManager' => [
            'converter' => [
                'class' => 'nizsheanez\assetConverter\Converter',
                'parsers' => [
                    'less' => [ // file extension to parse
                        'asConsoleCommand' => true,
                    ]
                ],
                'force' => true
            ]
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
    ],
    'params' => $params,
);
