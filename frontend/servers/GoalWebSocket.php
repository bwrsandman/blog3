<?php

class GoalWebSocket extends \PHPDaemon\Core\AppInstance
{
    public $enableRPC = true; // Без этой строчки не будут работать широковещательные вызовы
    public $sessions = []; // Здесь будем хранить указатели на сессии подключившихся клиентов

    // С этого метода начинается работа нашего приложения
    public function onReady()
    {
        $appInstance = $this;

        \PHPDaemon\Servers\WebSocket\Pool::getInstance()->addRoute($this->getConfig()->path->value, function ($client) use ($appInstance) {
            $session = new GoalWebSocketRoute($client, $appInstance); // Создаем сессию
            $session->id = uniqid(); // Назначаем ей уникальный ID
            $this->sessions[$session->id] = $session; //Сохраняем в массив
            return $session;
        });

        //yii preconfiguring
        $configs = require(__DIR__ . '/../config/frontend_configs.php');
        new \nizsheanez\websocket\Application($configs);
    }

    public function initYiiApplication($config, $applicationClass = '\nizsheanez\websocket\Application')
    {
        return new $applicationClass($config);
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
        file_put_contents('php://stdout', getmypid()."\n");

        Yii::$app->request->setRequestMessage($message);
        Yii::$app->response->setRequestMessage($message);
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