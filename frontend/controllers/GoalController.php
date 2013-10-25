<?php
namespace frontend\controllers;

use common\models\Goal;
use Exception;
use yii\base\Controller;
use Yii;

class GoalController extends Controller
{

    public function actionAll()
    {
        $models = Goal::find()->asArray()->all();
        foreach ($models as $k => $v) {
            $models[$k]['completed'] = (bool)$v['completed'];
        }
        Yii::$app->response->success($models);
    }

    public function actionCreate()
    {
        $params = Yii::$app->request->getParams();
        $model = new Goal();
        $model->scenario = 'create';
        $model->attributes = $params;
        if ($model->save()) {
            Yii::$app->response->success(Goal::find($model->id)->toArray());
        } else {
            Yii::$app->response->fail($model->getErrors());
        }
    }

    public function actionDelete()
    {
        $params = Yii::$app->request->getParams();
        $model = $this->findModel($params);
        if ($model->delete()) {
            Yii::$app->response->success('Deleted');
        } else {
            Yii::$app->response->fail('Some internal error');
        }
    }

    public function actionEdit()
    {
        $params = Yii::$app->request->getParams();
        $model = $this->findModel($params);
        $model->scenario = 'edit';
        $model->attributes = $params;
        if ($model->save()) {
            Yii::$app->response->success('Edited');
        } else {
            Yii::$app->response->fail($model->getErrors());
        }
    }

    protected function findModel($params)
    {
        if (($model = Goal::find($params['id'])) !== null) {
            return $model;
        } else {
            throw new Exception('The requested goal does not exist.');
        }
    }
}