<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);

// fcgi doesn't have STDIN defined by default
defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/yii/Yii.php');
Yii::importNamespaces(require(__DIR__ . '/vendor/composer/autoload_namespaces.php'));

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/console/config/main.php'),
    require(__DIR__ . '/console/config/main-local.php')
);

return new yii\console\Application($config);