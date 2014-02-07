<?php
require(__DIR__ . '/../../common/components/debug.php');

ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('xdebug.max_nesting_level', 1000);

ini_set('session.cookie_lifetime', 60 * 60 * 24 * 30);

// comment out the following line to disable debug mode
defined('YII_DEBUG') or define('YII_DEBUG', true);

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/frontend_configs.php');
$application = new yii\web\Application($config);
$application->run();
