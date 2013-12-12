<?php
namespace frontend\modules\v1;

use yii\base\Module;
use Yii;
use yii\web\Response;

class V1 extends Module
{
    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSONP;
        return parent::beforeAction($action);
    }

}