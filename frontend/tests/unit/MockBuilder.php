<?php

namespace tests\unit;

use \PHPUnit_Framework_MockObject_MockBuilder;
use yii\base\Exception;

class MockBuilder extends PHPUnit_Framework_MockObject_MockBuilder
{
	public function setMethods($methods)
	{
		$isValid = is_array($methods) || is_null($methods);
		if (!$isValid) {
			throw new Exception('first argument of setMethods must be array or null');
		}
		return parent::setMethods($methods);
	}

	public function getMock()
	{
		$a = parent::getMock();
		return $a;
	}

}