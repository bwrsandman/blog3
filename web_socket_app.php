<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/yii/Yii.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/console/config/main.php'),
    require(__DIR__ . '/console/config/main-local.php')
);

return new nizsheanez\websocket\Application($config);