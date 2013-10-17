<?php
use PHPDaemon\Core\Daemon;
use PHPDaemon\Core\Timer;

class MyWebSocket extends \PHPDaemon\Core\AppInstance {

    public $enableRPC=true; // Без этой строчки не будут работать широковещательные вызовы
    public $sessions=array(); // Здесь будем хранить указатели на сессии подключившихся клиентов

    // С этого метода начинается работа нашего приложения
    public function onReady() {
        $appInstance = $this;

        // Метод timerTask() будет вызываться каждые 5 секунд
        $this->timerTask($appInstance);

        // Наше приложение будет доступно по адресу ws://site.com:8047/goals
        \PHPDaemon\Servers\WebSocket\Pool::getInstance()->addRoute('goals', function ($client) use ($appInstance) {
            $session=new MyWebSocketRoute($client, $appInstance); // Создаем сессию
            $session->id=uniqid(); // Назначаем ей уникальный ID
            $this->sessions[$session->id]=$session; //Сохраняем в массив
            return $session;
        });


        //yii application instance init
        defined('YII_DEBUG') or define('YII_DEBUG', true);

        $dir = realpath(__DIR__ . '/../../../');

        require($dir . '/vendor/autoload.php');
        require($dir . '/vendor/yiisoft/yii2/yii/Yii.php');

        Yii::importNamespaces(require($dir . '/vendor/composer/autoload_namespaces.php'));

        $config = yii\helpers\ArrayHelper::merge(
            require($dir . '/frontend/config/main.php'),
            require($dir . '/frontend/config/main-local.php')
        );
        new yii\console\Application($config);
    }

    function timerTask($appInstance) {
        // Отправляем каждому клиенту свое сообщение
//        foreach($this->sessions as $id=>$session) {
//            $session->client->sendFrame('This is private message to client with ID '.$id, 'STRING');
//        }

        // После отправляем всем клиентам сообщение от каждого воркера (широковещательный вызов)
//        $appInstance->broadcastCall('sendBcMessage', array(Daemon::$process->getPid()));

        // Перезапускаем наш метод спустя 5 секунд
//        Timer::add(function($event) use ($appInstance) {
//            $this->timerTask($appInstance);
//            $event->finish();
//        }, 5e6); // Время задается в микросекундах
    }

    // Функция для широковещательного вызова (при вызове срабатывает во всех воркерах)
    public function sendBcMessage($pid) {
//        foreach($this->sessions as $id=>$session) {
//            $session->client->sendFrame('==This is broadcast message from worker #'.$pid, 'STRING');
//        }
    }

}

class MyWebSocketRoute extends \PHPDaemon\WebSocket\Route {

    public $client;
    public $appInstance;
    public $id; // Здесь храним ID сессии

    public function __construct($client,$appInstance) {
        $this->client=$client;
        $this->appInstance=$appInstance;
//        include dirname(__FILE__).'/../yiiapp.php';
        // comment out the following line to disable debug mode

    }

    // Этот метод срабатывает сообщении от клиента
    public function onFrame($data, $type) {
        $request = new common\components\PhpDaemonRequest();
        $request->setMessage($data);
        Yii::$app->setComponent('request', $request);

        $response = new common\components\PhpDaemonResponse();
        Yii::$app->setComponent('response', $response);
        Yii::$app->run();

        $response = json_encode(array(
            'route' => $request->getRoute(),
            'response' => Yii::$app->response->getData()
        ));

        $this->client->sendFrame($response, 'STRING');
    }

    // Этот метод срабатывает при закрытии соединения клиентом
    public function onFinish() {
        // Удаляем сессию из массива
        unset($this->appInstance->sessions[$this->id]);
    }

}