<?php
use PHPDaemon\Core\Daemon;
use PHPDaemon\Core\Timer;

class GoalWebSocket extends \PHPDaemon\Core\AppInstance
{
    public $enableRPC = true; // Без этой строчки не будут работать широковещательные вызовы
    public $sessions = array(); // Здесь будем хранить указатели на сессии подключившихся клиентов

    // С этого метода начинается работа нашего приложения
    public function onReady()
    {
        $appInstance = $this;

        // Наше приложение будет доступно по адресу ws://site.com:8047/goals
        \PHPDaemon\Servers\WebSocket\Pool::getInstance()->addRoute('goals', function ($client) use ($appInstance) {
            $session = new GoalWebSocketRoute($client, $appInstance); // Создаем сессию
            $session->id = uniqid(); // Назначаем ей уникальный ID
            $this->sessions[$session->id] = $session; //Сохраняем в массив
            return $session;
        });

        $root = realpath(__DIR__ . '/../../');
        require $root . '/web_socket_app.php';
    }

}

class GoalWebSocketRoute extends \PHPDaemon\WebSocket\Route
{
    public $client;
    public $appInstance;
    public $id; // Здесь храним ID сессии

    public function __construct($client, $appInstance)
    {
        $this->client = $client;
        $this->appInstance = $appInstance;
    }

    // Этот метод срабатывает сообщении от клиента
    public function onFrame($message, $type)
    {
        Yii::$app->request->setMessage($message);
        Yii::$app->response->setDaemonRoute($this);
        Yii::$app->run();
    }

    // Этот метод срабатывает при закрытии соединения клиентом
    public function onFinish()
    {
        // Удаляем сессию из массива
        unset($this->appInstance->sessions[$this->id]);
    }

}