<?php

namespace nizsheanez\ws;

use Yii;

class Request extends \yii\web\Request
{
    public $uri;

    public function getUrl()
    {
        $this->setUrl($this->resolveRequestUri());
        return parent::getUrl();
    }

    public function getPathInfo()
    {
        $this->setPathInfo($this->resolvePathInfo());
        return parent::getPathInfo();
    }

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

    public function getParams()
    {
        return $_GET;
    }

}
