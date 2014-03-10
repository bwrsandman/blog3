<?php
// Here you can initialize variables that will for your tests

\Codeception\Util\Autoload::registerSuffix('Steps', __DIR__.DIRECTORY_SEPARATOR.'_steps');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../config/main.php'),
    require(__DIR__ . '/../../config/codeception/acceptance.php')
);

$application = new yii\web\Application($config);
//$f = new \frontend\tests\fixtures\InitDbFixture();
//$f->beforeLoad();
//$f->load();
//$f->afterLoad();
//$application->fixture->load(['goal']);
