<?php
use yii\db\Schema;

class m131008_114135_goal_to_step extends \yii\db\Migration
{
    public function up()
    {
        // MySQL-specific table options. Adjust if you plan working with another DBMS
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('step', array(
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'fk_goal' => Schema::TYPE_INTEGER . ' NOT NULL',

            'status' => 'tinyint NOT NULL DEFAULT 0',
            'create_time' => Schema::TYPE_INTEGER . ' NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . ' NOT NULL',
        ), $tableOptions);
    }

    public function down()
    {
        $this->dropTable('step');
        return true;
    }
}
