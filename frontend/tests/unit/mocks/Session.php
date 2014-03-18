<?php
namespace frontend\tests\unit\mocks;

class Session extends \yii\web\Session
{
    public function init()
    {
        $_SESSION = [];
    }
	public function open()
	{
		$_SESSION = [];
	}
}