<?php
// Here you can initialize variables that will for your tests

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../config/main.php'),
    require(__DIR__ . '/../../config/codeception/unit.php')
);

$application = new yii\web\Application($config);
