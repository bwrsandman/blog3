<?php
namespace frontend\tests\unit\models;

use Codeception\Module\CodeHelper;
use Yii;
use yii\codeception\TestCase;
use \Codeception\Util\Stub;


class ReportTest extends \tests\unit\Test
{
	public $class = '\common\models\Report';

	public $guyClass = '\CodeGuy';


	public function testStripTagsBeforeValidate()
	{
		$model = $this->getMockBuilder($this->class)
			->setMethods(['trigger', 'stripTags'])
			->getMock();


		$model->expects($this->once())
			->method('stripTags')
			->with('description');


		$model->beforeValidate();
	}

	public function testStripTagsWithDefaultAllowedTags()
	{
		$model = $this->getMockBuilder($this->class)
			->setMethods(['trigger'])
			->getMock();

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
		$model = $this->getMockBuilder($this->class)
			->setMethods(['trigger'])
			->getMock();

		$model->description = '<iframe></iframe><img/><p></p><script></script>';
		$model->stripTags('description', '<iframe><script>');

		$this->assertContains('<iframe>', $model->description);
		$this->assertContains('<script>', $model->description);

		$this->assertNotContains('<img/>', $model->description);
		$this->assertNotContains('<p>', $model->description);
		$this->assertNotContains('<input type="checkbox"/>', $model->description);
	}

	public function testCreateQuery()
	{
		$model = $this->getMockBuilder($this->class)
			->setMethods(null)
			->getMock();

		$this->assertInstanceOf('common\models\ReportQuery', $model->createQuery());
	}

	public function testCreateRelation()
	{
		$model = $this->getMockBuilder($this->class)
			->setMethods(null)
			->getMock();

		$this->assertInstanceOf('common\models\ReportRelation', $model->createRelation());
	}

}