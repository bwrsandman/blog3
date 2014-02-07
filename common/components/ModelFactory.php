<?php
namespace common\components;

use \yii\base\Component;

/**
 * Class ModelFactory
 * @package common\components
 *
 * @property $report
 * @property $goal
 * @property $goal_category
 * @property $step
 * @property $conclusion
 */
class ModelFactory extends Component
{
	protected $modelMap = [
		'report'        => '\common\models\Report',
		'goal'          => '\common\models\Goal',
		'goal_category' => '\common\models\GoalCategory',
		'step'          => '\common\models\Step',
		'conclusion'    => '\common\models\Conclusion',
	];


	public function __get($id)
	{
		return $this->modelMap[$id];
	}

	public function __set($id, $class)
	{
		if (!is_string($class)) {
			throw new \Exception('Invalid Parameters');
		}
		$this->modelMap[$id] = $class;
	}

}