<?php
namespace frontend\controllers;

use common\models\Conclusion;
use yii\base\Controller;
use yii\base\Exception;
use Yii;

class ConclusionController extends Controller
{
    public function actionIndex()
    {
        $days = [
            'today',
            'yesterday'
        ];
        foreach ($days as $day) {
            $result[$day] = [
                'conclusion' => Conclusion::find()->owner(Yii::$app->user->getId())->day($day)->one()->toArray(),
            ];
        }

        echo json_encode($result);
    }

    public function actionSave()
    {
        $params = Yii::$app->request->getRestParams();
        if (isset($params['id'])) {
            $model = Conclusion::find($params['id']);
            $model->scenario = 'update';
        } else {
            $model = new Conclusion();
            $model->scenario = 'create';
        }
        $model->attributes = $params;
        if ($model->update(false)) {
            echo json_encode(Conclusion::find($model->id)->toArray());
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