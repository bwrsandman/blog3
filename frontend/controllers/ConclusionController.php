<?php
namespace frontend\controllers;

use common\models\Goal;
use common\models\User;
use yii\base\Controller;
use yii\base\Exception;
use Yii;

class ConclusionController extends Controller
{
    public function actionIndex()
    {
        /** @var $models Goal[] */
        $conclusions = Goal::find()->owner(Yii::$app->user->getId())->all();
        $result = [];
        foreach ($models as $model) {
            $result[] = $model->toArray();
        }

        echo json_encode($result);
    }

    public function actionSave()
    {
        $params = Yii::$app->request->getRestParams();
        $model = new Goal();
        $model->isNewRecord = !isset($params['id']);
        $model->scenario = $model->isNewRecord ? 'create' : 'update';
        $model->attributes = $params;
        if ($model->save()) {
            echo json_encode(Goal::find($model->id)->toArray());
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
        echo json_encode($this->findModel($params)->toArray());
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