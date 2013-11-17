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
        /** @var $models Goal[] */
        $models = Goal::find()->owner(1)->all();
        $result = [];
        foreach ($models as $model) {
            $result[$model->id] = $model->toArray();
        }

        return $result;
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
            $model->throwValidationErrors();
        }
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
        $model->reportYesterday->scenario = $model->reportToday->scenario = 'edit';
        $model->attributes = $params;
        if ($model->save()) {
            return 'Edited';
        } else {
            throw new Exception(json_encode($model->getErrors()));
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