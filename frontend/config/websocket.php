<?php
$main = require 'main.php';


$websocket = array(
    'id'                  => 'app-frontend-websocket',
    'components'          => [
        'request' => [
            'class' => 'nizsheanez\websocket\Request',
        ],
        'response' => [
            'class' => 'nizsheanez\websocket\Response',
        ],
        'session' => [
            'class' => 'common\components\Session'
        ]
    ],
);

return \yii\helpers\ArrayHelper::merge($main, $websocket);
