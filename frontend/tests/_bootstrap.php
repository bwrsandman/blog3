<?php
// the entry script URL (without host info) for functional and acceptance tests
defined('TEST_ENTRY_URL') or define('TEST_ENTRY_URL', '/basic/web/index-test.php');

// the entry script file path for functional and acceptance tests
defined('TEST_ENTRY_FILE') or define('TEST_ENTRY_FILE', dirname(__DIR__) . '/web/index-test.php');

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

// This is global bootstrap for autoloading
\Codeception\Util\Autoload::registerSuffix('Page', __DIR__ . DIRECTORY_SEPARATOR . '_pages');

require_once(__DIR__ . '/../../vendor/autoload.php');
require_once(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

// set correct script paths
$_SERVER['SCRIPT_FILENAME'] = TEST_ENTRY_FILE;
$_SERVER['SCRIPT_NAME'] = TEST_ENTRY_URL;
$_SERVER['SERVER_NAME'] = 'localhost';

Yii::setAlias('@tests', __DIR__);

//$kernel = \AspectMock\Kernel::getInstance();
//$kernel->init([
//	'debug' => true,
//	'includePaths' => [__DIR__.'/../../vendor/codeception/aspect-mock/src']
//]);