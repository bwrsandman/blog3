<?php
use yii\db\Schema;

class m131220_035744_goal_category extends \yii\db\Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('goal_category', array(
            'id'          => Schema::TYPE_PK,
            'name'        => 'varchar(50)',
            'create_time' => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT CURRENT_TIMESTAMP',
            'update_time' => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT 0',
        ), $tableOptions);

        $this->addColumn('goal', 'fk_goal_category', Schema::TYPE_INTEGER . ' NOT NULL');

        $this->batchInsert('goal_category', ['name'], [
            ['Professional'],
            ['Health'],
            ['Own'],
            ['Global']
        ]);

        $this->update('goal', [
            'fk_goal_category' => 1
        ]);

        $this->addForeignKey('goal_to_category', 'goal', 'fk_goal_category', 'goal_category', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('goal_to_category', 'goal');
        $this->dropColumn('goal', 'fk_goal_category', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->dropTable('goal_category');
    }
}
