<?php
namespace frontend\modules\v1\controllers;

use common\models\Conclusion;
use common\models\Goal;
use common\models\GoalCategory;
use common\models\User;
use yii\base\Controller;
use yii\base\Exception;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class UserController extends Controller
{
    public function actionIndex()
    {
        /** @var $models Goal[] */
        $models = Goal::find()->owner(Yii::$app->user->getId())->all();
        $goals = [];
        foreach ($models as $model) {
            $goals[] = $model->toArray();
            $goalToCategory[$model->fk_goal_category][] = $model->id;
        }

        $days = [
            'today',
            'yesterday'
        ];

        /** @var $models Goal[] */
//        echo Yii::$app->user->getId();die;
        $user = User::find(1);
        $conclusions = [];
        foreach ($days as $day) {
            $conclusions[$day] = $user->getConclusion($day)->toArray();
        }

        $response = [
            'categories' => GoalCategory::find()->asArray()->all(),
            'goals' => $goals,
            'goalToCategory' => $goalToCategory,
            'conclusions' => $conclusions,
        ];

        return $response;
    }

    /**
     * @param $params
     * @return Conclusion
     * @throws \yii\base\Exception
     */
    protected function findModel($params)
    {
        if (($model = Conclusion::find($params['id'])) !== null) {
            return $model;
        } else {
            throw new Exception('The requested goal does not exist.');
        }
    }
}