<?php

class m131104_170313_goal_add_description extends \yii\db\Migration
{
    public function up()
    {
        $this->addColumn('goal', 'description', 'text NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('goal', 'description');

        return true;
    }
}
