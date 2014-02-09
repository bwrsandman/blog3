<?php
use \Codeception\Util\Stub;
use \tests\unit\Test;

class GoalTest extends Test
{
	public $class = '\frontend\modules\v1\controllers\GoalController';
	public $goalClass = '\common\models\Goal';

    public function testActionIndex() {
	    $goal = Mockery::mock($this->goalClass);
		$goal->shouldReceive('toArray')->andReturn(['id' => 1], ['id' => 2], ['id' => 3]);

	    $goals = [
		    $goal,
		    $goal,
		    $goal,
	    ];

	    $c = $this->getMockBuilder($this->class)
	        ->disableOriginalConstructor()
		    ->setMethods(['findModelsByOwner'])
		    ->getMock();

		$c->expects($this->once())->method('findModelsByOwner')->will($this->returnValue($goals));

	    $result = $c->actionIndex();

	    $this->assertArrayHasKey('id', $result[0]);
	    $this->assertArrayHasKey('id', $result[1]);
	    $this->assertArrayHasKey('id', $result[2]);

	    $this->assertEquals(1, $result[0]['id']);
	    $this->assertEquals(2, $result[1]['id']);
	    $this->assertEquals(3, $result[2]['id']);
    }

}