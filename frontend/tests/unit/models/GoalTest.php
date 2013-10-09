<?php
namespace frontunit\models;

use common\models\Goal;
use Yii;
use yii\data\DataProviderInterface;
use yiiunit\TestCase;

/**
 * GoalTest
 * @group models
 */
class GoalTest extends TestCase
{
    public $aliases;

    public function tearUp()
    {
        parent::tearUp();
    }

    public function testSearch()
    {
        $goal = new Goal();
        $this->assertTrue($goal->search() instanceof DataProviderInterface);
    }
}
