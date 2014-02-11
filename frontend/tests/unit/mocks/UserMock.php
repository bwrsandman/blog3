<?php
namespace frontend\tests\unit\mocks;

use yii\web\User;

class UserMock extends User
{
	public function getId()
	{
		return 1;
	}
}