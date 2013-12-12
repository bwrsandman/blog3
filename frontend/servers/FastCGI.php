<?php
namespace frontend\servers;

class FastCGI extends \PHPDaemon\Core\AppInstance
{
    public $sessions = []; // Здесь будем хранить указатели на сессии подключившихся клиентов

    public $yiiDebug = false;

    public $routeClass = '\nizsheanez\daemon\Route';

    public function onReady()
    {
        $this->initRoutes();
    }

    public function initRoutes()
    {
        $appInstance = $this;
        $path = '';


//        \PHPDaemon\Servers\FastCGI\Pool::getInstance()->addRoute($path, function ($client) use ($path, $appInstance) {
//            return $appInstance->getRoute($path, $client);
//        });
    }

    public function getRoute($path, $client)
    {
        switch ($path)
        {
            case '':
                $route = new $this->routeClass($client, $this); // Создаем сессию
                $route->id = uniqid(); // Назначаем ей уникальный ID
                $this->sessions[$route->id] = $route; //Сохраняем в массив
                return $route;
        }

    }
}