<?php

class m131117_034632_goal_fk_user_key extends \yii\db\Migration
{
    public function up()
    {
        $this->addForeignKey('user_to_goal', 'goal', 'fk_user', 'user', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('user_to_goal', 'goal');

        return true;
    }
}
