<?php
use \Codeception\Util\Stub;
use \tests\unit\Test;
use \common\models\Goal;

class GoalControllerTest extends Test
{
	public $class = '\frontend\modules\v1\controllers\GoalController';
	public $goalClass = '\common\models\Goal';

	public function testActionIndex()
	{
		$goal = $this->getMock($this->goalClass, ['getFullData']);

		$goal->expects($this->at(0))->method('getFullData')->will($this->returnValue(['id' => 1]));
		$goal->expects($this->at(1))->method('getFullData')->will($this->returnValue(['id' => 2]));
		$goal->expects($this->at(2))->method('getFullData')->will($this->returnValue(['id' => 3]));

		$goals = [
			$goal,
			$goal,
			$goal,
		];

		$controller = $this->getMockBuilder($this->class)
			->disableOriginalConstructor()
			->setMethods(['findModelsByOwner'])
			->getMock();

		$controller->expects($this->once())->method('findModelsByOwner')->will($this->returnValue($goals));

		$result = $controller->actionIndex();

		$this->assertArrayHasKey('id', $result[0]);
		$this->assertArrayHasKey('id', $result[1]);
		$this->assertArrayHasKey('id', $result[2]);

		$this->assertEquals(1, $result[0]['id']);
		$this->assertEquals(2, $result[1]['id']);
		$this->assertEquals(3, $result[2]['id']);
	}

	public function testActionSaveNewGoal()
	{
		$controller = $this->getMock($this->class, ['newModel', 'findModel'], [1, $this]);
		$model      = $this->getMock($this->goalClass, ['save', 'getFullData']);

		$controller->expects($this->any())->method('newModel')->will($this->returnValue($model));
		$controller->expects($this->once())->method('findModel')->will($this->returnValue($model));
		$model->expects($this->once())->method('save')->will($this->returnCallback(function () use ($model) {
			$model->id = 1;
			return true;
		}));
		$model->expects($this->once())->method('getFullData')->will($this->returnCallback(function () use ($model) {
			return $model->toArray();
		}));

		$result = $controller->actionSave();

		$this->assertEquals(1, $result['id']);
		$this->assertEquals(Goal::COMPLETED_NO, $result['completed']);
		$this->assertEquals('create', $model->scenario);
	}

	public function testActionSaveExistsGoal()
	{
		$controller = $this->getMock($this->class, ['newModel', 'findModel'], [1, $this]);
		$model      = $this->getMock($this->goalClass, ['save']);

		$this->setRequestParameters(['id' => 1]);

		$controller->expects($this->never())->method('newModel')->will($this->returnValue($model));
		$controller->expects($this->exactly(2))->method('findModel')->will($this->returnValue($model));
		$model->expects($this->once())->method('save')->will($this->returnValue(true));

		$controller->actionSave();

		$this->assertEquals('update', $model->scenario);
	}

	/**
	 * @expectedException \yii\base\Exception
	 */
	public function testActionSaveWithFailedModelSave()
	{
		$controller = $this->getMock($this->class, ['newModel', 'findModel'], [1, $this]);
		$model      = $this->getMock($this->goalClass, ['save']);

		$this->setRequestParameters(['id' => 1]);
		$controller->expects($this->never())->method('newModel')->will($this->returnValue($model));
		$controller->expects($this->once())->method('findModel')->will($this->returnValue($model));
		$model->expects($this->once())->method('save')->will($this->returnValue(false));

		$controller->actionSave();

		$this->assertEquals('update', $model->scenario);
	}

	public function testActionDelete()
	{
		$controller = $this->getMock($this->class, ['findModel'], [1, $this]);
		$model      = $this->getMock($this->goalClass, ['delete']);

		$controller->expects($this->once())->method('findModel')->will($this->returnValue($model));
		$model->expects($this->once())->method('delete')->will($this->returnValue(true));

		$result = $controller->actionDelete();

		$this->assertArrayHasKey('message', $result);
		$this->assertContains('Deleted', $result['message']);
	}

	/**
	 * @expectedException \yii\base\Exception
	 */
	public function testActionDeleteWithFailResult()
	{
		$controller = $this->getMock($this->class, ['findModel'], [1, $this]);
		$model      = $this->getMock($this->goalClass, ['delete']);

		$controller->expects($this->once())->method('findModel')->will($this->returnValue($model));
		$model->expects($this->once())->method('delete')->will($this->returnValue(false));

		$controller->actionDelete();
	}

	public function testActionView()
	{
		$controller = $this->getMock($this->class, ['findModel'], [1, $this]);
		$model      = $this->getMock($this->goalClass, ['delete']);

		//twice because for different id
		$controller->expects($this->exactly(2))->method('findModel')->will($this->returnCallback(function ($params) use ($model) {
			$model->id = $params['id'];
			return $model;
		}));

		$this->setRequestParameters(['id' => 1]);
		$result1 = $controller->actionView();

		$this->setRequestParameters(['id' => 2]);
		$result2 = $controller->actionView();

		$this->assertEquals(1, $result1['id']);
		$this->assertEquals(2, $result2['id']);
	}
}