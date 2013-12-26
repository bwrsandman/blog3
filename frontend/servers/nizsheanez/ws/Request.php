<?php

namespace nizsheanez\ws;

use Yii;

class Request extends \yii\web\Request
{
    public $uri;

    public function getRoute()
    {
        return $this->getMethod();
    }

    public function getScriptUrl()
    {
        return '/index.php';
    }

    protected function resolveRequestUri()
    {
        return $this->uri;
    }
}
