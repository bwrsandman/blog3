<?php

namespace common\components;

class PhpDaemonRequest extends \yii\base\Request
{
    private $_params;
    private $_route;
    private $_message;

    /**
     * Returns the command line arguments.
     * @return array the command line arguments. It does not include the entry script name.
     */
    public function getParams()
    {
        return $this->_params;
    }

    public function getRoute() {
        return $this->_route;
    }

    /**
     * Sets the command line arguments.
     * @param array $params the command line arguments
     */
    public function setMessage($message)
    {
        $this->_message = $message;
    }

    /**
     * Resolves the current request into a route and the associated parameters.
     * @return array the first element is the route, and the second is the associated parameters.
     */
    public function resolve()
    {
        if (!$this->_params || !$this->_route) {
            $message = json_decode($this->_message);

            $this->_route = $message->route;
            foreach($message->request as $k => $v) {
                $this->_params[$k] = $v;
            }
        }
        return array($this->_route, $this->_params);
    }

    public function validateCsrfToken() {
        return true;
    }
}
