<?php

namespace nizsheanez\ws;

use Yii;

class Request extends \yii\web\Request
{
    public $uri;

    public function getScriptUrl()
    {
        return '/index.php';
    }

    /**
     * Unify interface for cli and websocket app,
     * this method return query parameters
     *
     * @return mixed
     */
    public function getParams()
    {
        return $_GET;
    }

}
