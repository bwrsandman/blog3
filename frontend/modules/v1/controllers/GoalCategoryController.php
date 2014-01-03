<?php
namespace frontend\modules\v1\controllers;

use common\models\GoalCategory;
use yii\base\Controller;
use yii\base\Exception;
use Yii;

class GoalCategoryController extends Controller
{
    public function actionIndex()
    {
        /** @var $models GoalCategory[] */
        $models = GoalCategory::find()->owner(Yii::$app->user->getId())->all();
        $result = [];
        foreach ($models as $model) {
            $result[] = $model->toArray();
        }

        return $result;
    }

    public function actionSave()
    {
        $params = Yii::$app->request->getParams();

        if (isset($params['id'])) {
            $model = GoalCategory::find($params['id']);
            $model->scenario = 'update';
        } else {
            $model = new GoalCategory();
            $model->scenario = 'create';
        }

        $model->attributes = $params;
        if ($model->save()) {
            return GoalCategory::find($model->id)->toArray();
        } else {
            $model->throwValidationErrors();
//            return $model->getErrors();
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
     * @return GoalCategory
     * @throws \yii\base\Exception
     */
    protected function findModel($params)
    {
        if (($model = GoalCategory::find($params['id'])) !== null) {
            return $model;
        } else {
            throw new Exception('The requested GoalCategory does not exist.');
        }
    }
}