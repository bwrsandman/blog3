<?php
namespace frontend\modules\v1\controllers;

use common\models\Conclusion;
use common\models\Goal;
use PHPDaemon\Core\Daemon;
use yii\base\Controller;
use yii\base\Exception;
use Yii;
use yii\web\Response;

class GoalController extends Controller
{

    public function actionIndex()
    {
        $result = [];
        foreach ($this->findModelsByOwner(Yii::$app->user->id) as $model) {
            $result[] = $model->toArray();
        }

        return $result;
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

    public function actionSave()
    {
        $params = Yii::$app->request->get();
        if (isset($params['id'])) {
            $model = Goal::find($params['id']);
            $model->scenario = 'update';
        } else {
            $model = new Goal();
            $model->scenario = 'create';
            $model->completed = Goal::COMPLETED_NO;
        }
        $model->attributes = $params;
        $model->fk_user = Yii::$app->user->getId();

        if ($model->save()) {
            return Goal::find($model->id)->toArray();
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