<?php
namespace frontend\tests\unit\mocks;

class UserIdentity extends \common\models\User
{
	public function getId()
	{
		return 1;
	}
}