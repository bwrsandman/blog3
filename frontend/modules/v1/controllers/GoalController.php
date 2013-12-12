<?php
namespace frontend\modules\v1\controllers;

use common\models\Goal;
use yii\base\Controller;
use yii\base\Exception;
use Yii;
use yii\web\Response;

class GoalController extends Controller
{

    public function actionIndex()
    {
        /** @var $models Goal[] */
        $models = Goal::find()->owner(Yii::$app->user->getId())->all();
        $result = [];
        foreach ($models as $model) {
            $result[] = $model->toArray();
        }

        return $result;
    }

    public function actionSave()
    {
        $params = Yii::$app->request->getRestParams();
        if (isset($params['id'])) {
            $model = Goal::find($params['id']);
            $model->scenario = 'update';
        } else {
            $model = new Conclusion();
            $model->scenario = 'create';
        }
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

    public function actionView()
    {
        $params = Yii::$app->request->get();
        return $this->findModel($params)->toArray();
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