<?php
namespace frontend\servers;

class WebSocket extends \nizsheanez\websocket\Server
{
    public $routeClass = '\frontend\servers\Route';

    public function onReady()
    {
        parent::onReady();
    }

}

