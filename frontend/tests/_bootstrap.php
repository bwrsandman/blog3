<?php
// This is global bootstrap for autoloading 

\Codeception\Util\Autoload::registerSuffix('Page', __DIR__ . DIRECTORY_SEPARATOR . '_pages');

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require_once(__DIR__ . '/../../vendor/autoload.php');
require_once(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
Yii::setAlias('@tests', __DIR__);

//$kernel = \AspectMock\Kernel::getInstance();
//$kernel->init([
//	'debug' => true,
//	'includePaths' => [__DIR__.'/../../vendor/codeception/aspect-mock/src']
//]);