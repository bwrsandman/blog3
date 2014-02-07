<?php
namespace frontend\tests\unit\models;

use Codeception\Module\CodeHelper;
use Yii;
use yii\codeception\TestCase;
use \Codeception\Util\Stub;


class GoalTeest extends TestCase
{
//	use \Codeception\Specify;

	public $class = '\common\models\Goal';
	public $reportClass = '\common\models\Report';

	public $guyClass = '\CodeGuy';

	public function providerDays()
	{
		return [
			['today'],
			['yesterday']
		];
	}

	/**
	 * @dataProvider providerDays
	 *
	 * @param $day
	 */
	public function testGetReportFromDb($day)
	{
		$model = $this->getMockBuilder($this->class)
			->setMethods(['hasOne'])
			->getMock();

		$relation = $this->getMockBuilder('\yii\db\ActiveRelation')
			->setMethods(['day', 'one'])
			->getMock();


		$model->expects($this->any())
			->method('hasOne')
			->will($this->returnValue($relation));

		$relation->expects($this->once())
			->method('day')
			->will($this->returnSelf());

		$relation->expects($this->once())
			->method('one')
			->will($this->returnValue(new $this->reportClass));

		$this->assertInstanceOf($this->reportClass, $model->getReport($day));
	}

	/**
	 * @dataProvider providerDays
	 *
	 * @param $day
	 */
	public function testGetReportIfNotExistsInDb($day)
	{
		$model = $this->getMockBuilder($this->class)
			->setMethods(['hasOne', 'createReportByDay'])
			->getMock();

		$relation = $this->getMockBuilder('\yii\db\ActiveRelation')
			->setMethods(['day', 'one'])
			->getMock();


		$model->expects($this->any())
			->method('hasOne')
			->will($this->returnValue($relation));

		$model->expects($this->once())
			->method('createReportByDay')
			->will($this->returnValue(new $this->reportClass));


		$relation->expects($this->once())
			->method('day')
			->will($this->returnSelf());

		$relation->expects($this->once())
			->method('one')
			->will($this->returnValue(null));


		$this->assertInstanceOf($this->reportClass, $model->getReport($day));
	}

	/**
	 * @dataProvider providerDays
	 */
	public function testCreateReportByDay($day)
	{
		$model = $this->getMockBuilder($this->class)
			->setMethods(['reportInstance'])
			->getMock();

		$report = $this->getMockBuilder($this->reportClass)
			->setMethods(['save'])
			->getMock();


		$model->expects($this->once())
			->method('reportInstance')
			->will($this->returnValue($report));

		$report->expects($this->once())
			->method('save')
			->will($this->returnValue(true));


		Yii::$app->models->report = get_class($report);

		$this->assertInstanceOf($this->reportClass, $model->createReportByDay($day));
	}

	/**
	 * @dataProvider providerDays
	 * @expectedException \Exception
	 */
	public function testCreateReportByDayWithFailedSave($day)
	{
		$report = $this->getMockBuilder($this->reportClass)
			->setMethods(['save'])
			->getMock();

		$model = $this->getMockBuilder($this->class)
			->setMethods(['reportInstance'])
			->getMock();


		$model->expects($this->once())
			->method('reportInstance')
			->will($this->returnValue($report));

		$report->expects($this->once())
			->method('save')
			->will($this->returnValue(false));

		Yii::$app->models->report = get_class($report);

		$model->createReportByDay($day);
	}
}