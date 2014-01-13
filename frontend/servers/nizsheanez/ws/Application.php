<?php
namespace nizsheanez\ws;

use Yii;
use Exception;

class Application extends \yii\web\Application
{
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
