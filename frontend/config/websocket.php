<?php
$main = require 'main.php';

$websocket = array(
    'id'                  => 'app-frontend-websocket',
    'components'          => [
        'request' => array(
            'class' => 'nizsheanez\ws\Request',
        ),
        'response' => array(
            'class' => 'nizsheanez\ws\Response',
        ),
    ],
);

return \yii\helpers\ArrayHelper::merge($main, $websocket);
