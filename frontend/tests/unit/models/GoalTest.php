<?php
namespace frontend\tests\unit\models;

use Codeception\Module\CodeHelper;
use Yii;
use yii\codeception\TestCase;
use \Codeception\Util\Stub;
use \tests\unit\Test;

class GoalTest extends Test
{
	public $class = '\common\models\Goal';
	public $reportClass = '\common\models\Report';

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
		$model = $this->getMock($this->class, ['hasOne']);
		$query = $this->getMock('\yii\db\ActiveQuery', ['day', 'one'], [$this->class]);

		$model->expects($this->any())->method('hasOne')->will($this->returnValue($query));

        $query->expects($this->once())->method('day')->will($this->returnSelf());
        $query->expects($this->once())->method('one')->will($this->returnValue(new $this->reportClass));

		$this->assertInstanceOf($this->reportClass, $model->getReport($day));
	}

	/**
	 * @dataProvider providerDays
	 *
	 * @param $day
	 */
	public function testGetReportIfNotExistsInDb($day)
	{
		$model = $this->getMock($this->class, ['hasOne', 'createReportByDay']);
		$query = $this->getMock('\yii\db\ActiveQuery', ['day', 'one'], [$this->class]);

		$model->expects($this->any())->method('hasOne')->will($this->returnValue($query));
		$model->expects($this->once())->method('createReportByDay')->will($this->returnValue(new $this->reportClass));

        $query->expects($this->once())->method('day')->will($this->returnSelf());
        $query->expects($this->once())->method('one')->will($this->returnValue(null));

		$this->assertInstanceOf($this->reportClass, $model->getReport($day));
	}

	/**
	 * @dataProvider providerDays
	 */
	public function testCreateReportByDay($day)
	{
		$model = $this->getMock($this->class, ['reportInstance']);
		$report = $this->getMock($this->reportClass, ['save']);

		$model->expects($this->once())->method('reportInstance')->will($this->returnValue($report));
		$report->expects($this->once())->method('save')->will($this->returnValue(true));

		Yii::$app->models->report = get_class($report);

		$this->assertInstanceOf($this->reportClass, $model->createReportByDay($day));
	}

	/**
	 * @dataProvider providerDays
	 * @expectedException \Exception
	 */
	public function testCreateReportByDayWithFailedSave($day)
	{
		$report = $this->getMock($this->reportClass, ['save']);
		$model = $this->getMock($this->class, ['reportInstance']);

		$model->expects($this->once())->method('reportInstance')->will($this->returnValue($report));
		$report->expects($this->once())->method('save')->will($this->returnValue(false));

		Yii::$app->models->report = get_class($report);

		$model->createReportByDay($day);
	}

	/**
	 * @dataProvider providerDays
	 */
	public function testToArray($day)
	{
		$model = $this->getMockBuilder($this->class)->setMethods(['getReport'])->getMock();

		$model->expects($this->any())->method('getReport')->will($this->returnValue(new $this->reportClass));

		$result = $model->getFullData();
		$this->assertArrayHasKey($day, $result);
		$this->assertArrayHasKey('report', $result[$day]);
	}

	public function testFind()
	{
		$model = $this->getMock($this->class, null);

		$this->assertInstanceOf('common\models\GoalQuery', $model->find());
	}

	public function testSearch()
	{
		$model = $this->getMock($this->class, null);

		$this->assertInstanceOf('yii\data\ArrayDataProvider', $model->search());
	}

	public function testSetAttributes()
	{
		$values = [
			'today'     => [
				'report' => [
					'id' => 1
				]
			],
			'yesterday' => [
				'report' => [
					'id' => 2
				]
			]
		];

		$model = $this->getMock($this->class, ['getReport']);

		$report1 = $this->getMockBuilder($this->reportClass)->setMethods(['setAttributes'])->getMock();
		$report1->expects($this->any())
			->method('setAttributes')
			->will($this->returnCallback(function ($attributes) use ($report1) {
				foreach ($attributes as $k => $v) {
					$report1->$k = $v;
				}
			}));

		$report2 = $this->getMockBuilder($this->reportClass)->setMethods(['setAttributes'])->getMock();
		$report2->expects($this->any())
			->method('setAttributes')
			->will($this->returnCallback(function ($attributes) use ($report2) {
				foreach ($attributes as $k => $v) {
					$report2->$k = $v;
				}
			}));

		//set attributes
		$model->expects($this->at(0))->method('getReport')->will($this->returnValue($report1));
		$model->expects($this->at(1))->method('getReport')->will($this->returnValue($report2));

		//to array
		$model->expects($this->at(2))->method('getReport')->will($this->returnValue($report1));
		$model->expects($this->at(3))->method('getReport')->will($this->returnValue($report2));

		$model->attributes = $values;

		$result = $model->getFullData();
		$this->assertArrayHasKey('today', $result);
		$this->assertArrayHasKey('yesterday', $result);
		$this->assertArrayHasKey('report', $result['today']);
		$this->assertArrayHasKey('report', $result['yesterday']);
		$this->assertEquals(1, $result['today']['report']['id']);
		$this->assertEquals(2, $result['yesterday']['report']['id']);
	}
}