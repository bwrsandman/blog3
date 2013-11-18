<?php
use yii\db\Schema;

class m131118_045335_conclusion extends \yii\db\Migration
{
    public function up()
    {
        // MySQL-specific table options. Adjust if you plan working with another DBMS
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('conclusion', array(
            'id'          => Schema::TYPE_PK,
            'create_time' => Schema::TYPE_TIMESTAMP . '',
            'description' => Schema::TYPE_TEXT,
            'fk_user'     => Schema::TYPE_INTEGER . ' NOT NULL',
            'update_time' => Schema::TYPE_TIMESTAMP . ' DEFAULT 0',
            'report_date' => Schema::TYPE_DATE . ' NOT NULL'
        ), $tableOptions);
    }

    public function down()
    {
        $this->dropTable('conclusion');

        return true;
    }
}
