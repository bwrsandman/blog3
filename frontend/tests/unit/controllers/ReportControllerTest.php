<?php
use \Codeception\Util\Stub;
use \tests\unit\Test;
use \common\models\Goal;

class ReportControllerTest extends Test
{
	public $class = '\frontend\modules\v1\controllers\ReportController';
	public $reportClass = '\common\models\Report';

	/**
	 * @expectedException \yii\base\Exception
	 */
	public function testActionSaveNewReportMustFailed()
	{
		$controller = $this->getMock($this->class, null, [1, Yii::$app->getModule('v1')]);

		$this->setRequestParameters([]);
		$controller->actionSave();
	}

	public function _testActionSaveExistsReport()
	{
		$controller = $this->getMock($this->class, ['findModel'], [1, $this]);
		$model      = $this->getMock($this->reportClass, ['save']);

		$controller->expects($this->exactly(2))->method('findModel')->will($this->returnValue($model));
		$model->expects($this->once())->method('save')->will($this->returnValue(true));

		$this->setRequestParameters(['id' => 1]);
		$controller->actionSave();

		$this->assertEquals('update', $model->scenario);
	}

	/**
	 * @expectedException \yii\base\Exception
	 */
	public function _testActionSaveWithFailedModelSave()
	{
		$controller = $this->getMock($this->class, ['findModel'], [1, $this]);
		$model      = $this->getMock($this->reportClass, ['save']);

		$controller->expects($this->once())->method('findModel')->will($this->returnValue($model));
		$model->expects($this->once())->method('save')->will($this->returnValue(false));

		$this->setRequestParameters(['id' => 1]);
		$controller->actionSave();

		$this->assertEquals('update', $model->scenario);
	}

}