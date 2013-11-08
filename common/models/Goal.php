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

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['id, title, completed', 'safe', 'on' => 'create'],
            ['title', 'string', 'min' => 3, 'max' => 1024, 'on' => 'create'],
            ['title, completed', 'safe', 'on' => 'edit'],
            ['title', 'string', 'min' => 3, 'max' => 1024, 'on' => 'edit'],
        ]);
    }

    public function transactions()
    {
        return [
            'create' => self::OP_INSERT,
            'edit' => self::OP_INSERT | self::OP_UPDATE | self::OP_DELETE,
        ];
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
            ->andWhere('create_time >= :today')
            ->params([
                ':today' => date('Y-m-d', strtotime('today')),
            ]);
        return $query;
    }

    public function getReportYesterday()
    {
        $query = $this->getReport();
        $query->andWhere('create_time >= :yesterday')
            ->andWhere('create_time < :today')
            ->params([
                ':today' => date('Y-m-d', strtotime('today')),
                ':yesterday' => date('Y-m-d', strtotime('yesterday'))
            ]);
        return $query;
    }

    public function beforeSave($event)
    {
        if (parent::beforeSave($event)) {
            $saved = $this->reportToday->save() && $this->reportYesterday->save();
            if (!$saved) {
                return false;
            }
        }
        return true;
    }
}
