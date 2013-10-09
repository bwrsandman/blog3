<?php

define('YII_ENABLE_ERROR_HANDLER', false);
define('YII_DEBUG', true);
$_SERVER['SCRIPT_NAME'] = '/' . __DIR__;
$_SERVER['SCRIPT_FILENAME'] = __FILE__;

require_once(__DIR__ . '/../../../vendor/yiisoft/yii2/yii/Yii.php');

Yii::setAlias('@frontunit', __DIR__);
Yii::setAlias('common', __DIR__.'/../../../common');
Yii::setAlias('frontend', __DIR__ . '/../../../frontend');
Yii::setAlias('backend', __DIR__ . '/../../../backend');

require_once(__DIR__ . '/TestCase.php');