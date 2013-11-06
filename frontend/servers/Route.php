<?php
namespace frontend\servers;

class Route extends \nizsheanez\daemon\websocket\Route
{
    public function onFrame($message, $type)
    {
        parent::onFrame($message, $type);
    }
}
