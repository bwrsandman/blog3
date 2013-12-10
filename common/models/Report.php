<?php
namespace common\models;

use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Report extends generated\Report
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [
                ['id'],
                'safe',
                'on' => 'create'
            ],
            [
                ['description'],
                'string',
                'max' => 30000,
                'on'  => 'update'
            ],
            [
                ['description'],
                'strip'
            ]
        ]);
    }

    public function strip($attr)
    {
        $this->$attr = strip_tags($this->$attr, '<input><b><em><br>');
        return true;
    }

    public static function day(Query $query, $day)
    {
        $query
            ->andWhere('report_date >= :day')
            ->andWhere('report_date < :nexDay')
            ->addParams([
                ':day'    => static::date($day),
                ':nexDay' => static::date($day . ' +1 day')
            ]);

        return $query;
    }

    public function beforeSave($event)
    {
        if (parent::beforeSave($event)) {
            $this->description = str_replace("\n", "<br/>", $this->description);
            $this->description = Html::encode($this->description);
            return true;
        }
        return false;
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->description = Html::decode($this->description);
    }
}