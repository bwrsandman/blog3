<?php

class m131106_140515_goal_kill_descr extends \yii\db\Migration
{
	public function up()
	{
        $this->dropColumn('goal', 'description');
	}

	public function down()
	{
		return true;
	}
}
