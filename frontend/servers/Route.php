<?php
namespace frontend\servers;

class Route extends \nizsheanez\websocket\Route
{
    public function onFrame($message, $type)
    {
        parent::onFrame($message, $type);
    }
}
