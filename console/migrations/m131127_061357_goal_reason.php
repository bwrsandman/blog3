<?php

use yii\db\Schema;

class m131127_061357_goal_reason extends \yii\db\Migration
{
	public function up()
	{
        $this->addColumn('goal', 'reason', Schema::TYPE_TEXT);
	}

	public function down()
	{
        $this->dropColumn('goal', 'reason');
		return true;
	}
}
