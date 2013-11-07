<?php
namespace frontend\controllers;

use common\models\Goal;
use common\models\Report;
use yii\base\Controller;
use yii\base\Exception;
use Yii;

class GoalController extends Controller
{

    public function actionAll()
    {
        /** @var $models Goal[] */
        $models = Goal::find()->with('reportToday', 'reportYesterday')->all();
        foreach ($models as $k => $v) {
            /** @var $model Goal */
            $model = $models[$k];
            if (!$model->reportToday) {
                $report = new Report();
                $report->scenario = 'create';
                $report->fk_goal = $model->id;
                $model->description = '';
                $report->save();
            }
        }

        //reload
        $models = Goal::find()->with('reportToday', 'reportYesterday')->all();
        $result = [];
        foreach ($models as $k => $v) {
            $result[] = $model->toArray();
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