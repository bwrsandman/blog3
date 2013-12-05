<?php

use yii\db\Schema;

class m131205_071341_decomposition extends \yii\db\Migration
{
	public function up()
	{
        $this->addColumn('goal', 'decomposition', Schema::TYPE_TEXT);
        $this->addColumn('goal', 'comments', Schema::TYPE_TEXT);
	}

	public function down()
	{
        $this->dropColumn('goal', 'decomposition');
        $this->dropColumn('goal', 'comments');
        return true;
	}
}
