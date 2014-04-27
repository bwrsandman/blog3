<?php
namespace frontend\modules\goals\controllers\v1;

use common\models\Report;
use PHPDaemon\Core\Daemon;
use yii\base\Controller;
use yii\base\Exception;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\VarDumper;

class ReportController extends Controller
{
    public function actionSave()
    {
        $params            = Yii::$app->request->get();
        $model             = $this->findModel($params);
        $model->scenario   = 'update';
        $model->attributes = $params;

        if (!$model->checkUserPermissions()) {
            throw new Exception('Access denied');
        }

        if ($model->save()) {
            return $this->findModel($model->id)->toArray();
        } else {
            $model->throwValidationErrors();
        }
    }

    /**
     * @param $params
     *
     * @return Report
     * @throws \yii\base\Exception
     */
    protected function findModel($params)
    {
        switch (true) {
            case is_numeric($params):
                $id = $params;
                break;
            case isset($params['id']):
                $id = $params['id'];
                break;
            default:
                throw new InvalidParamException('Id of Report must be specify. But ' . VarDumper::dump($params) . ' given');
        }

        $model = $this->find($id);

        if ($model === null) {
            throw new Exception('The requested Report does not exist. But ' . var_export($model, true) . ' given');
        }

        return $model;
    }

    protected function find($id)
    {
        return Report::findOne($id);
    }
}