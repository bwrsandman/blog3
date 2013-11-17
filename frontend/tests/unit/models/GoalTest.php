<?php
namespace frontunit\models;

use common\models\Goal;
use Yii;
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

    public function testGetReportToday()
    {
        Goal::find()->one();

    }
}
