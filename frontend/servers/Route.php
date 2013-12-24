<?php
namespace frontend\servers;

use common\components\Wamp;

class Route extends \nizsheanez\websocket\Route
{
    public $prefixes = array();

    /**
     * @var \frontend\servers\WebSocket
     */
    public $appInstance;

    public $wamp;

    public function onHandshake() {
        $wamp = $this->wamp = new Wamp($this);
        $this->client->onSessionStart(function() use($wamp) {
            if (!isset($this->client->session['counter'])) {
                $this->client->session['counter'] = 0;
            }
            ++$this->client->session['counter'];
            $wamp->onOpen();
//            $this->client->sessionCommit();
        });
    }


    // Этот метод срабатывает сообщении от клиента
    public function onFrame($message, $type)
    {
//        $ws = $this;
//        $wamp->onMessage($message);
    }


    /**
     * {@inheritdoc}
     */
    public function onCall($id, $topic, array $params)
    {
        $this->appInstance->onCall($this->conn, $id, $this->getTopic($topic), $params);
    }

    /**
     * {@inheritdoc}
     */
    public function onSubscribe($id)
    {
        $this->appInstance->pubsub->sub($id, $this->client, function () {
        });
    }

    public function getUri($uri)
    {
        return (array_key_exists($uri, $this->prefixes) ? $this->prefixes[$uri] : $uri);
    }


    /**
     * {@inheritdoc}
     */
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

    public function send($obj)
    {
        $this->client->sendFrame($obj, 'STRING');
        return $this;
    }

    public function onFinish()
    {
        $this->appInstance->pubsub->unsubFromAll($this);
        return $this;
    }
}
