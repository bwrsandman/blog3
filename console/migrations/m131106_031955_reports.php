<?php
use yii\db\Schema;

class m131106_031955_reports extends \yii\db\Migration
{
	public function up()
	{
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('report', array(
            'id' => Schema::TYPE_PK,
            'description' => Schema::TYPE_TEXT,
            'fk_goal' => Schema::TYPE_INTEGER.' NOT NULL',
            'create_time' => Schema::TYPE_TIMESTAMP . '',
            'update_time' => Schema::TYPE_TIMESTAMP . ' DEFAULT 0',
        ), $tableOptions);

	}

	public function down()
	{
        $this->dropTable('report');
        return true;
	}
}
