<?php
namespace frontend\controllers;

use common\models\Goal;
use yii\base\Controller;
use yii\base\Exception;
use Yii;

class GoalController extends Controller
{

    public function actionAll()
    {
        $models = Goal::find()->asArray()->all();
        foreach ($models as $k => $v) {
            $models[$k]['completed'] = (bool)$v['completed'];
        }
        return $models;
    }

    public function actionCreate()
    {
        $params = Yii::$app->request->getParams();
        $model = new Goal();
        $model->scenario = 'create';
        $model->attributes = $params;
        if ($model->save()) {
            return Goal::find($model->id)->toArray();
        } else {
            throw new Exception($model->getErrors());
        }
    }

    public function actionDetail()
    {

        $params = Yii::$app->request->getParams();

        return [
            'steps' => $this->findModel($params)->getSteps()->asArray()->all()
        ];
    }

    public function actionDelete()
    {
        $params = Yii::$app->request->getParams();
        $model = $this->findModel($params);
        if ($model->delete()) {
            return 'Deleted';
        } else {
            throw new Exception('Some internal error');
        }
    }

    public function actionEdit()
    {
        $params = Yii::$app->request->getParams();
        $model = $this->findModel($params);
        $model->scenario = 'edit';
        $model->attributes = $params;
        if ($model->save()) {
            return 'Edited';
        } else {
            throw new Exception($model->getErrors());
        }
    }

    /**
     * @param $params
     * @return Goal
     * @throws \yii\base\Exception
     */
    protected function findModel($params)
    {
        if (($model = Goal::find($params['id'])) !== null) {
            return $model;
        } else {
            throw new Exception('The requested goal does not exist.');
        }
    }
}