<?php
use yii\db\Schema;

class m131114_075839_user extends \yii\db\Migration
{
    public function up()
    {
        // MySQL-specific table options. Adjust if you plan working with another DBMS
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('user', [
            'id'                   => Schema::TYPE_PK,
            'username'             => 'varchar(255) NOT NULL',
            'auth_key'             => 'varchar(32) NOT NULL',
            'password_hash'        => 'varchar(255) NOT NULL',
            'password_reset_token' => 'varchar(32) DEFAULT NULL',
            'email'                => 'varchar(255) NOT NULL',
            'role'                 => 'tinyint(4) NOT NULL',
            'status'               => 'tinyint(4) NOT NULL',
            'create_time'          => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT CURRENT_TIMESTAMP',
            'update_time'          => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT 0',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('user');

        return true;
    }
}
