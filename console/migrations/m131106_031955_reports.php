<?php
use yii\db\Schema;

class m131106_031955_reports extends \yii\db\Migration
{
	public function up()
	{
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('report', array(
            'id' => Schema::TYPE_PK,
            'description' => Schema::TYPE_TEXT . ' NOT NULL',
            'fk_goal' => Schema::TYPE_INTEGER.' UNSIGNED NOT NULL',
            'create_time' => Schema::TYPE_INTEGER.' UNSIGNED NOT NULL',
            'update_time' => Schema::TYPE_INTEGER.' UNSIGNED NOT NULL',
        ), $tableOptions);

        $this->addForeignKey('report_to_goal_1', 'report', 'fk_goal', 'goal', 'id');
	}

	public function down()
	{
        $this->dropForeignKey('report_to_goal_1', 'report');
        $this->dropTable('report');
        return true;
	}
}
