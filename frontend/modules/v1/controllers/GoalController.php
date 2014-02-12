<?php
namespace frontend\modules\v1\controllers;

use common\models\Goal;
use yii\base\Controller;
use yii\base\Exception;
use Yii;

class GoalController extends Controller
{

    public function actionIndex()
    {
	    $result = [];
        foreach ($this->findModelsByOwner(Yii::$app->user->id) as $model) {
            $result[] = $model->getFullData();
        }

        return $result;
    }


    public function actionSave()
    {
        $params = Yii::$app->request->get();
        if (isset($params['id'])) {
            $model = $this->findModel($params);
            $model->scenario = 'update';
        } else {
            $model = $this->newModel();
            $model->scenario = 'create';
            $model->completed = Goal::COMPLETED_NO;
        }
        $model->attributes = $params;
        $model->fk_user = Yii::$app->user->getId();

        if ($model->save()) {
            return $this->findModel(['id' => $model->id])->getFullData();
        } else {
            $model->throwValidationErrors();
//            return $model->getErrors();
        }
    }

    public function actionDelete()
    {
        $params = Yii::$app->request->get();
        $model = $this->findModel($params);
        if ($model->delete()) {
            return [
	            'message' => 'Deleted'
            ];
        } else {
            throw new Exception('Some internal error');
        }
    }

    public function actionView()
    {
        $params = Yii::$app->request->get();
        return $this->findModel($params)->getFullData();
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

	/**
	 * @param $ownerId
	 *
	 * @return \common\models\Goal[]
	 */
	public function findModelsByOwner($ownerId)
	{
		/** @var $models Goal[] */
		$models = Goal::find()->owner($ownerId)->all();
		return $models;
	}


	public function newModel()
	{
		return new Goal;
	}
}