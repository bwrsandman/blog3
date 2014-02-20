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

	public static function checkEmptyInterface($args)
	{
		if (count($args) > 0) {
			throw new Exception("Method can't get parameters");
		}
	}

	public static function returnSelf()
	{
		static::checkEmptyInterface(func_get_args());
		return parent::returnSelf();
	}

	public static function once()
	{
		static::checkEmptyInterface(func_get_args());
		return parent::once();
	}

	public static function never()
	{
		static::checkEmptyInterface(func_get_args());
		return parent::never();
	}

	public static function atLeastOnce()
	{
		static::checkEmptyInterface(func_get_args());
		return parent::atLeastOnce();
	}

	public static function any()
	{
		static::checkEmptyInterface(func_get_args());
		return parent::atLeastOnce();
	}


}