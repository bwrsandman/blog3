<?php
namespace frontend\modules\goals;

use yii\base\Module;
use Yii;
use yii\web\Response;

class Goals extends Module
{

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

}