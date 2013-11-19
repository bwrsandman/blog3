<?php
namespace common\components;

class Request extends \yii\web\Request
{
    protected $restParams;

    public function getRestParams()
    {
        if ($this->restParams === null) {
            if (isset($_POST[$this->restVar])) {
                $this->restParams = $_POST;
            } else {
                $this->restParams = json_decode($this->getRawBody(), true);
            }
        }
        return $this->restParams;
    }

}