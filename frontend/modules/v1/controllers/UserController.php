<?php
namespace frontend\modules\v1\controllers;

use common\models\Conclusion;
use common\models\Goal;
use yii\base\Controller;
use yii\base\Exception;
use Yii;
use yii\web\Response;

class UserController extends Controller
{

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

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