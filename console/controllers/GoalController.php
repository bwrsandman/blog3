<?php
namespace console\controllers;

use common\models\Goal;
use yii\console\Controller;
use Yii;

class GoalController extends Controller {

    public function actionAll()
    {
        $models = Goal::find()->asArray()->all();
        foreach ($models as $k => $v) {
            $models[$k]['completed'] = (bool)$v['completed'];
        }
        Yii::$app->response->data = $models;
    }
}