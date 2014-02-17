<?php
namespace frontend\modules\v1\controllers;

use common\models\Report;
use PHPDaemon\Core\Daemon;
use yii\base\Controller;
use yii\base\Exception;
use Yii;
use yii\base\InvalidParamException;

class ReportController extends Controller
{
    public function actionSave()
    {
        $params = Yii::$app->request->get();
	    $model = $this->findModel($params);
        $model->scenario = 'update';
        $model->attributes = $params;

        if ($model->save()) {
	        return $this->findModel($model->id)->toArray();
        } else {
	        $model->throwValidationErrors();
        }
    }

    /**
     * @param $params
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
			    throw new InvalidParamException('Id of Report must be specify');
	    }

	    $model = Report::find($id);

	    if ($model === null) {
		    throw new Exception('The requested Report does not exist.');
	    }

        return $model;
    }
}