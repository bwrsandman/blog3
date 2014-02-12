<?php

namespace tests\unit;

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

}