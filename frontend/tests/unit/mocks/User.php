<?php
namespace frontend\tests\unit\mocks;

class User extends \yii\web\User
{
	public function getId()
	{
		return 1;
	}
}