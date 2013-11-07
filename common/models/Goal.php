<?php
namespace common\models;

use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

class Goal extends generated\Goal
{
    public function search()
    {
        return new ArrayDataProvider;
    }

    public function rules() {
        return ArrayHelper::merge(parent::rules(), [
            ['id, title, completed', 'safe', 'on' => 'create'],
            ['title', 'string', 'min' => 3, 'max' => 1024, 'on' => 'create'],
            ['title, completed', 'safe', 'on' => 'edit'],
            ['title', 'string', 'min' => 3, 'max' => 1024, 'on' => 'edit'],
        ]);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getReport()
    {
        return $this->hasOne(Report::className(), ['fk_goal' => 'id']);
    }

    /**
     * @return static
     */
    public function getReportToday()
    {
        $query = $this->getReport()
            ->andWhere('create_time > '. strtotime('today'));
        return $query;
    }

    public function getReportYesterday()
    {
        $query = $this->getReport()
            ->andWhere('create_time > '. strtotime('yesterday'))
            ->andWhere('create_time < '. strtotime('today'));
        return $query;
    }
}
