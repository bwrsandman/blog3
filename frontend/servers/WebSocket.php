<?php
namespace frontend\servers;

class WebSocket extends \nizsheanez\websocket\Server
{
    public $routeClass = '\frontend\servers\Route';

    public $pubsub;

    public function __construct($name = '')
    {
        $this->pubsub = new \PHPDaemon\PubSub\PubSub();
        parent::__construct($name = '');
    }


}

