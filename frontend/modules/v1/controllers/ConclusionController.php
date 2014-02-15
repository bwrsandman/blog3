<?php
namespace frontend\modules\v1\controllers;

use common\models\Conclusion;
use PHPDaemon\Core\Daemon;
use yii\base\Controller;
use yii\base\Exception;
use Yii;
use yii\web\Response;

class ConclusionController extends Controller
{
    public function actionIndex()
    {
        $days = [
            'today',
            'yesterday'
        ];
        $result = [];
        foreach ($days as $day) {
            $result[$day] = [
                'conclusion' => Conclusion::find()->owner(Yii::$app->user->getId())->day($day)->one()->toArray(),
            ];
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
            $model = new Conclusion();
            $model->scenario = 'create';
        }
        $model->attributes = $params;
        if ($model->save()) {
            return $this->findModel(['id' => $model->id])->toArray();
        } else {
            $model->throwValidationErrors();
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