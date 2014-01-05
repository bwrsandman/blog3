<?php
namespace frontend\modules\v1\controllers;

use common\models\Conclusion;
use common\models\Goal;
use common\models\GoalCategory;
use common\models\User;
use PHPDaemon\Core\Daemon;
use yii\base\Controller;
use yii\base\Exception;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class UserController extends Controller
{
    public function actionView()
    {
        return Yii::$app->user->identity->getInitPageData();
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