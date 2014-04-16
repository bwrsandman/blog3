<?php
namespace frontend\modules\goals\controllers\v1;

use common\models\GoalCategory;
use PHPDaemon\Core\Daemon;
use yii\base\Controller;
use yii\base\Exception;
use Yii;

class GoalCategoryController extends Controller
{
    public function actionIndex()
    {
        $result = [];
        foreach ($this->findModelsByOwner(Yii::$app->user->getId()) as $model) {
            $result[] = $model->toArray();
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
            $model = new GoalCategory();
            $model->scenario = 'create';
        }

        $model->attributes = $params;

	    if ($model->save()) {
            return $this->findModel(['id' => $model->id])->toArray();
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
     * @return GoalCategory
     * @throws \yii\base\Exception
     */
    protected function findModel($params)
    {
        if (($model = GoalCategory::findOne($params['id'])) !== null) {
            return $model;
        } else {
            throw new Exception('The requested GoalCategory does not exist.');
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
		$models = GoalCategory::find()->owner($ownerId)->all();
		return $models;
	}

}