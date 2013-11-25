<?php
use \yii\db\Schema;

class m131111_071946_report_date extends \yii\db\Migration
{
    public function up()
    {
        $this->addColumn('report', 'report_date', Schema::TYPE_DATE . ' NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('report', 'report_date');

        return true;
    }
}
