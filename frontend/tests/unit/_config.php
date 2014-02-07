<?php
return yii\helpers\ArrayHelper::merge(
	require(__DIR__ . '/../../config/main.php'),
	require(__DIR__ . '/../_config.php')
);
