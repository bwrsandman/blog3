<?php
namespace common\components;

class Request extends \yii\web\Request
{
    public function get($name, $defaultValue = null)
    {
        return isset($_GET[$name]) ? $_GET[$name] : $defaultValue;
    }
}