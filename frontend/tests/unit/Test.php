<?php

namespace tests\unit;

use yii\codeception\TestCase;

class Test extends TestCase
{
	public $guyClass = '\CodeGuy';

	public function getMockBuilder($className)
	{
		return new MockBuilder($this, $className);
	}
}