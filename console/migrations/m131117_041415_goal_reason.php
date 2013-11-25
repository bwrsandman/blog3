<?php
use \yii\db\Schema;

class m131117_041415_goal_reason extends \yii\db\Migration
{
    public function up()
    {
        $this->addColumn('goal', 'reason', Schema::TYPE_TEXT);
    }

    public function down()
    {
        $this->dropColumn('goal', 'reason', Schema::TYPE_TEXT);

        return true;
    }
}
