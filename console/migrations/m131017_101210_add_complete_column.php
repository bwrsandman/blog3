<?php

class m131017_101210_add_complete_column extends \yii\db\Migration
{
	public function up()
	{
        $this->addColumn('goal', 'completed', 'tinyint(2) UNSIGNED NOT NULL');
	}

	public function down()
	{
        $this->dropColumn('goal', 'completed');
	}
}
