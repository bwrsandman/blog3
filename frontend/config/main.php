<?php
$rootDir = __DIR__ . '/../..';

$params = array_merge(
    require($rootDir . '/common/config/params.php'),
    require($rootDir . '/common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return array(
    'id'                  => 'app-frontend',
    'basePath'            => dirname(__DIR__),
    'vendorPath'          => dirname(dirname(__DIR__)) . '/vendor',
    'controllerNamespace' => 'frontend\controllers',
    'modules'             => [
        'gii' => [
            'class'      => 'yii\gii\Module',
            'allowedIPs' => [
                '192.168.56.1'
            ],
            'generators' => [
                'model' => [
                    'class'                      => 'yii\gii\generators\model\Generator',
                    'ns'                         => 'common\models\generated',
                    'baseClass'                  => '\common\components\ActiveRecord',
                    'generateLabelsFromComments' => true
                ]
            ],
        ],
        'v1'  => [
            'class' => 'frontend\modules\v1\V1',
        ]

    ],
    'extensions'          => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
    'components'          => [
        'db'           => $params['components.db'],
        'text'         => $params['components.text'],
        'sphinxDb'     => $params['components.sphinxDb'],
        'cache'        => $params['components.cache'],
        'mail'         => $params['components.mail'],
        'request'      => [
            'class' => 'common\components\Request'
        ],
        'user'         => [
            'class'         => 'yii\web\User',
            'identityClass' => 'common\models\User',
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                ''                                     => 'site/index',
                'gii'                                  => 'gii',
                'gii/<controller:\w+>/<action:\w+>'    => 'gii/<controller>/<action>',

                /*
                                'POST api/v1/<controller:\w+>/<id:\d+>'   => 'v1/<controller>/save',
                                'POST api/v1/<controller:\w+>'            => 'v1/<controller>/save',
                                'DELETE api/v1/<controller:\w+>/<id:\d+>' => 'v1/<controller>/delete',
                                'api/v1/<controller:\w+>/<id:\d+>'        => 'v1/<controller>/view',
                                'api/v1/<controller:\w+>'                 => 'v1/<controller>/index',
                */
                'api/v1/<controller:\w+>/<action:\w+>' => 'v1/<controller>/<action>',
            ]
        ],
        'assetManager' => [
            'converter' => [
                'class'   => 'nizsheanez\assetConverter\Converter',
                'parsers' => [
                    'less' => [ // file extension to parse
                        'asConsoleCommand' => true,
                    ]
                ],
                'force'   => true
            ]
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => [
                        'error',
                        'warning'
                    ],
                ],
            ],
        ],
    ],
    'params'              => $params,
);
