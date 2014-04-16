<?php
namespace frontend\tests\unit\models;

use Codeception\Module\CodeHelper;
use Yii;
use \Codeception\Util\Stub;
use \tests\unit\Test;

class ReportTest extends Test
{
	public $class = '\common\models\Report';
	public $goalClass = '\common\models\Goal';
	public $userClass = '\common\models\User';

	public function testStripTagsBeforeValidate()
	{
		$model = $this->getMock($this->class, ['trigger', 'stripTags']);


		$model->expects($this->once())
			->method('stripTags')
			->with('description');


		$model->beforeValidate();
	}

	public function testStripTagsWithDefaultAllowedTags()
	{
		$model = $this->getMock($this->class, ['trigger']);

		$model->description = '<iframe></iframe><img/><input type="checkbox"/><p></p><script></script>';
		$model->stripTags('description');

		$this->assertNotContains('<iframe>', $model->description);
		$this->assertNotContains('<script>', $model->description);
		$this->assertNotContains('<p>', $model->description);

		$this->assertContains('<img/>', $model->description);
		$this->assertContains('<input type="checkbox"/>', $model->description);
	}


	public function testStripTagsWithCustomAllowedTags()
	{
		$model = $this->getMock($this->class, ['trigger']);

		$model->description = '<iframe></iframe><img/><p></p><script></script>';
		$model->stripTags('description', '<iframe><script>');

		$this->assertContains('<iframe>', $model->description);
		$this->assertContains('<script>', $model->description);

		$this->assertNotContains('<img/>', $model->description);
		$this->assertNotContains('<p>', $model->description);
		$this->assertNotContains('<input type="checkbox"/>', $model->description);
	}

	public function testFind()
	{
		$model = $this->getMock($this->class, null);

		$this->assertInstanceOf('common\models\ReportQuery', $model->find());
	}

	public function testCheckUserPermissions()
	{
		$model                    = $this->getMock($this->class, ['getGoal']);
		$goal                     = $this->getMock($this->goalClass, ['getUser']);
		$user                     = $this->getMock($this->userClass, null);
		$userRight                = $this->getMockBuilder(get_class(Yii::$app->user))
			->disableOriginalConstructor()
			->setMethods(['getId'])
			->getMock();
		$userRight->identityClass = Yii::$app->user->identityClass;

		$userWrong = clone $userRight;

		$user->id = 1;
		$model->expects($this->exactly(2))->method('getGoal')->will($this->returnValue($goal));
		$goal->expects($this->exactly(2))->method('getUser')->will($this->returnValue($user));

		$userRight->expects($this->once())->method('getId')->will($this->returnValue(1));
		$userWrong->expects($this->once())->method('getId')->will($this->returnValue(2));

		Yii::$app->set('user', $userRight);
		$this->assertTrue($model->checkUserPermissions());

		Yii::$app->set('user', $userWrong);
		$this->assertFalse($model->checkUserPermissions());
	}

}