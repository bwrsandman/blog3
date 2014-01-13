<?php
namespace frontend\servers;

use common\components\Wamp;
use PHPDaemon\Core\Daemon;
use Yii;

class Route extends \nizsheanez\websocket\Route
{
    public $prefixes = array();

    /**
     * @var \frontend\servers\WebSocket
     */
    public $appInstance;

    /**
     * @var Wamp
     */
    public $wamp;

    public function onHandshake()
    {
        $wamp = $this->wamp = new Wamp($this);
        $wamp->onOpen();
    }


    public function onFrame($message, $type)
    {
        $this->beforeOnMessage();
        $message = substr($message, 0, strrpos($message, ']') + 1);

        $this->wamp->onMessage($message);
        $this->afterOnMessage();
    }

    /**
     * Create Yii application
     */
    public function beforeOnMessage()
    {
        $config = require __DIR__ . '/../../frontend/config/main.php';
        new \nizsheanez\ws\Application($config);
    }

    /**
     * Garbage Collection
     *
     * close sessions, destroy application, etc.
     */
    public function afterOnMessage()
    {
        $this->client->sessionCommit();
        Yii::$app->session->close();
        foreach (Yii::$app->getComponents() as $component) {
            unset($component);
        }
        Yii::$app = null;
    }

    /**
     * {@inheritdoc}
     */
    public function onCall($id, $topic, array $params)
    {
        $this->client->server['REQUEST_URI'] = str_replace($this->client->server['HTTP_ORIGIN'], '', $topic);
        Daemon::log($this->client->server['REQUEST_URI']);
        $_GET = $params;
        try {
            Yii::$app->run();
        } catch (\Exception $e) {
            Daemon::log($e);
        }
        $this->wamp->result($id, Yii::$app->response->data);
    }


    public function getUri($uri)
    {
        return (array_key_exists($uri, $this->prefixes) ? $this->prefixes[$uri] : $uri);
    }

    public function onSubscribe($id)
    {
        $this->appInstance->pubsub->sub($id, $this->client, function () {
        });
    }

    public function onUnsubscribe($id)
    {
        $this->appInstance->pubsub->unsub($id, $this);
    }

    /**
     * {@inheritdoc}
     */
    public function onPublish($id, $event, array $exclude, array $eligible)
    {
        $this->appInstance->pubsub->pub($id, $event);
    }

    /**
     * {@inheritdoc}
     */
    public function onClose()
    {
        $this->appInstance->pubsub->unsubFromAll($this);
    }

    /**
     * {@inheritdoc}
     */
    public function onError(\Exception $e)
    {
        return $this->_decorating->onError($this->client, $e);
    }

    public function send($message)
    {
        $this->client->sendFrame($message, 'STRING');

        return $this;
    }

    public function onFinish()
    {
        $this->appInstance->pubsub->unsubFromAll($this);

        return $this;
    }
}
