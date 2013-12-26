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

    public $wamp;

    public function onHandshake()
    {
        $this->client->onSessionStart(function ($event) {
//            Yii::$app->session->open();
//            Daemon::log(print_r($_SESSION, true) . "\n");
//            Daemon::log(print_r($this->client->session, true). "\n");
//            Daemon::log(session_id() . "\n");
//            Daemon::log($this->client->session. "\n");
//            Daemon::log($this->client->session->sessionId . "\n");
//            $_SESSION = &$this->client->session;
//
//            if (!isset($this->client->session['counter'])) {
//                $this->client->session['counter'] = 0;
//            }
//            ++$this->client->session['counter'];
//            file_put_contents('php://stdout', print_r($_SESSION, true) . "\n");
//            $this->client->sessionCommit();
        });
        $wamp = $this->wamp = new Wamp($this);
        $wamp->onOpen();
    }


    // Этот метод срабатывает сообщении от клиента
    public function onFrame($message, $type)
    {
        $this->wamp->onMessage($message);
    }

    /**
     * {@inheritdoc}
     */
    public function onCall($id, $topic, array $params)
    {
        Yii::$app->request->uri = str_replace($this->client->server['HTTP_ORIGIN'], '', $topic);
        $_GET = $params;
        try {
            /** @var $response \nizsheanez\ws\Response */
            $response = Yii::$app->run();
            Yii::$app->session->close();
        } catch (\Exception $e) {
            print_r($e);die;
        }
        $this->wamp->result($id, $response->data);
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
