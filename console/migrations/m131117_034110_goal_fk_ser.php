<?php
use \yii\db\Schema;

class m131117_034110_goal_fk_ser extends \yii\db\Migration
{
	public function up()
	{
        $this->addColumn('goal', 'fk_user', Schema::TYPE_INTEGER . ' NOT NULL');
	}

	public function down()
	{
        $this->dropColumn('goal', 'fk_user');
		return true;
	}
}
