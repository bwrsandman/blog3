<?php

class m131106_074246_reports_to_goal extends \yii\db\Migration
{
	public function up()
	{
        $this->addForeignKey('report_to_goal', 'report', 'fk_goal', 'goal', 'id');
	}

	public function down()
	{
        $this->dropForeignKey('report_to_goal', 'report');
		return true;
	}
}
