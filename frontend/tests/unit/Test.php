<?php

namespace tests\unit;

use yii\base\Exception;
use yii\codeception\TestCase;
use Yii;

class Test extends TestCase
{
	public $guyClass = '\CodeGuy';

	public function getMockBuilder($className)
	{
		return new MockBuilder($this, $className);
	}

	public function setRequestParameters($params)
	{
		Yii::$app->request->setQueryParams($params);
	}

	public static function returnSelf()
	{
		if (count(func_get_args()) > 0) {
			throw new Exception("Method returnSelf can't get parameters");
		}
		return parent::returnSelf();
	}

}