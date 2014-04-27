<?php
use \Codeception\Util\Stub;
use \tests\unit\Test;
use \common\models\Goal;

class ReportControllerTest extends Test
{
    public $class = '\frontend\modules\goals\controllers\v1\ReportController';
    public $reportClass = '\common\models\Report';
    public $goalClass = '\common\models\Goal';

    /**
     * @expectedException \yii\base\Exception
     */
    public function testActionSaveNewReportMustFailed()
    {
        $controller = $this->getMock($this->class, null, [1, Yii::$app->getModule('v1')]);

        $this->setRequestParameters(['id' => 1]);
        $controller->actionSave();
    }

    public function testActionSaveExistsReport()
    {
        $controller = $this->getMock($this->class, ['findModel'], [1, $this]);
        $model      = $this->getMock($this->reportClass, ['save', 'checkUserPermissions']);

        $controller->expects($this->exactly(2))->method('findModel')->will($this->returnValue($model));
        $model->expects($this->once())->method('save')->will($this->returnValue(true));
        $model->expects($this->once())->method('checkUserPermissions')->will($this->returnValue(true));

        $this->setRequestParameters(['id' => 1]);
        $controller->actionSave();

        $this->assertEquals('update', $model->scenario);
    }

    /**
     * @expectedException \yii\base\Exception
     */
    public function testActionSaveWithFailedModelSave()
    {
        $controller = $this->getMock($this->class, ['findModel'], [1, $this]);
        $model      = $this->getMock($this->reportClass, ['save', 'checkUserPermissions']);

        $controller->expects($this->any())->method('findModel')->will($this->returnValue($model));
        $model->expects($this->once())->method('checkUserPermissions')->will($this->returnValue(true));
        $model->expects($this->once())->method('save')->will($this->returnValue(false));

        $this->setRequestParameters(['id' => 1]);
        $controller->actionSave();

        $this->assertEquals('update', $model->scenario);
    }

    /**
     * @expectedException \yii\base\Exception
     */
    public function testActionSaveMustAccessDeniedIfWrongUser()
    {
        $controller = $this->getMock($this->class, ['findModel'], [1, $this]);
        $model      = $this->getMock($this->reportClass, ['save', 'checkUserPermissions']);

        $controller->expects($this->any())->method('findModel')->will($this->returnValue($model));
        $model->expects($this->once())->method('checkUserPermissions')->will($this->returnValue(false));
        $this->setRequestParameters(['id' => 1]);

        $controller->actionSave();
    }

}