<?php
namespace frontend\controllers;

use common\models\Conclusion;
use common\models\Goal;
use yii\base\Controller;
use yii\base\Exception;
use Yii;

class UserController extends Controller
{
    public function actionIndex()
    {
        /** @var $models Goal[] */
        $models = Goal::find()->owner(Yii::$app->user->getId())->all();
        $goals = [];
        foreach ($models as $model) {
            $goals[] = $model->toArray();
        }

        $days = [
            'today',
            'yesterday'
        ];
        /** @var $models Goal[] */
        $user = Yii::$app->user->getIdentity();
        $conclusions = [];
        foreach ($days as $day) {
            $conclusions[$day] = $user->getConclusion($day)->toArray();
        }

        $response = [
            'goals' => $goals,
            'conclusions' => $conclusions,
        ];

        echo json_encode($response);
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