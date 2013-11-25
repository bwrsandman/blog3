<?php
use yii\db\Schema;

class m131008_114135_goal_to_step extends \yii\db\Migration
{
    public function up()
    {
        $this->addForeignKey('steps_to_goal', 'step', 'fk_goal', 'goal', 'id');

    }

    public function down()
    {
        $this->dropForeignKey('steps_to_goal', 'step');

        return true;
    }
}
