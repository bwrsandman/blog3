<?php
namespace common\components;

class Request extends \yii\web\Request
{

    public function getRestParams()
    {
        if ($this->_restParams === null) {
            if (isset($_POST[$this->restVar])) {
                $this->_restParams = $_POST;
            } else {
                $this->_restParams = json_decode($this->getRawBody(), true);
            }
        }
        return $this->_restParams;
    }

}