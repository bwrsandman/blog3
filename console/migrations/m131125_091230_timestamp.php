<?php

use yii\db\Schema;

class m131125_091230_timestamp extends \yii\db\Migration
{
	public function up()
	{
        foreach (['goal', 'user', 'report', 'conclusion'] as $table) {
            $this->dropColumn($table, 'create_time');
            $this->dropColumn($table, 'update_time');
            $this->addColumn($table, 'create_time', Schema::TYPE_TIMESTAMP . ' NULL DEFAULT CURRENT_TIMESTAMP');
            $this->addColumn($table, 'update_time', Schema::TYPE_TIMESTAMP . ' NULL DEFAULT 0');
        }
	}

	public function down()
	{
		return true;
	}
}
