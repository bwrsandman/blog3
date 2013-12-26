<?php
namespace nizsheanez\ws;

use Yii;
use Exception;

class Application extends \yii\web\Application
{
    public function run()
    {
        $this->trigger(self::EVENT_BEFORE_REQUEST);
//        try {
            $response = $this->handleRequest($this->getRequest());
//            $response->success();
//        } catch (Exception $e) {
//            $response = $this->response;
//            $response->fail($e);
//        }
        $this->trigger(self::EVENT_AFTER_REQUEST);
        return $response;
    }

    /**
     * Registers the core application components.
     * @see setComponents
     */
    public function registerCoreComponents()
    {
        parent::registerCoreComponents();
        $this->setComponents(array(
            'request' => array(
                'class' => 'nizsheanez\ws\Request',
            ),
            'response' => array(
                'class' => 'nizsheanez\ws\Response',
            ),
        ));
    }

}
