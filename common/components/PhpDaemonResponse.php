<?php

namespace common\components;

class PhpDaemonResponse extends \yii\base\Response
{
    private $_data;

    public function setData($data)
    {
        $this->_data = $data;
    }

    public function getData()
    {
        return $this->_data;
    }
}
