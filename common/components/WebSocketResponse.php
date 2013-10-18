<?php

namespace common\components;

class WebSocketResponse extends \yii\base\Response
{
    public $data;

    public function getMessage()
    {
        return json_encode(array(
            'callbackId' => \Yii::$app->request->callbackId,
            'route' => \Yii::$app->request->route,
            'params' => $this->data
        ));
    }

    public function send()
    {

    }
}
