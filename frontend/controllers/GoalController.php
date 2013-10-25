<?php
namespace frontend\controllers;

use common\models\Goal;
use Yii;

class GoalController extends \yii\base\Controller {

    public function actionAll()
    {
        $models = Goal::find()->asArray()->all();
        foreach ($models as $k => $v) {
            $models[$k]['completed'] = (bool)$v['completed'];
        }
        Yii::$app->response->success($models);
    }

    public function actionCreate() {
        $params = Yii::$app->request->getParams();
        $goal = new Goal();
        $goal->scenario = 'create';
        $goal->attributes = $params;
        if ($goal->save()) {
            Yii::$app->response->success(Goal::find($goal->id)->toArray());
        } else {
            $errors = $goal->getFirstErrors();
            $message = count($errors) > 0 ? array_shift($errors) : 'Some internal error';
            Yii::$app->response->fail($message);
        }
    }

    public function actionDelete()
    {
        $params = Yii::$app->request->getParams();
        $model = Goal::find($params['id']);
        if ($model && $model->delete()) {
            Yii::$app->response->success('Deleted');
        } else {
            Yii::$app->response->fail('Some internal error');
        }
    }
}