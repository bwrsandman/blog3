<?php
use \CodeGuy;
use \Codeception\Util\Stub;

class GoalCest
{
	public $class = '\v1\controllers\Goal';
	public $goalClass = '\common\models\Goal';

    public function _before()
    {
    }

    public function _after()
    {
    }

    // tests
    public function actionIndex(CodeGuy $I) {
	    $controller = Stub::make($this->class, [
		    'findModelsByOwner' => function() {
				    $model = Stub::make($this->models,)
				return
		    }
	    ]);
	    $controller->actionIndex();
//        $I->haveStub
    }

}