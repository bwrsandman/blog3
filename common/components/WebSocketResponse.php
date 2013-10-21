<?php

namespace common\components;

class WebSocketResponse extends \yii\base\Response
{

    protected $data;

    /**
     * @var \PHPDaemon\WebSocket\Route
     */
    protected $daemonRoute;

    public function setDaemonRoute($route)
    {
        $this->daemonRoute = $route;
    }

    public function getMessage()
    {
        if (\Yii::$app->request->callbackId) {
            $this->data['callbackId'] = \Yii::$app->request->callbackId;
        }
        $this->data['route'] = \Yii::$app->request->route;

        return json_encode($this->data);
    }

    public function send()
    {
        $this->daemonRoute->client->sendFrame($this->getMessage(), 'STRING');
    }

    public function success($data)
    {
        $this->data = [
            'status' => 'success',
            'params' => $data
        ];
    }

    public function fail($data)
    {
        $this->data = [
            'status' => 'error',
            'error' => $data
        ];
    }
}
