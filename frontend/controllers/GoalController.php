<?php
namespace frontend\controllers;

use common\models\Goal;
use common\models\Report;
use yii\base\Controller;
use yii\base\Exception;
use Yii;
use yii\helpers\ArrayHelper;

class GoalController extends Controller
{

    public function actionAll()
    {
        /** @var $models Goal[] */
        $models = Goal::find()->with('reportToday', 'reportYesterday')->all();
        foreach ($models as $model) {
            if (!$model->reportToday) {
                $report = new Report();
                $report->scenario = 'create';
                $report->fk_goal = $model->id;
                $report->beforeSave(true);
                $report->save();
            }
        }

        //reload
        $models = Goal::find()->with('reportToday', 'reportYesterday')->all();
        $result = [];
        foreach ($models as $model) {
            $tmp = $model->toArray();
            $tmp['reportToday'] = $model->reportToday->toArray();
            if ($model->reportYesterday) {
                $tmp['reportYesterday'] = $model->reportYesterday->toArray();
            }
            $result[$model->id] = $tmp;
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
        $model->reportToday->attributes = $params['reportToday'];
        $model->reportYesterday->attributes = $params['reportYesterday'];
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