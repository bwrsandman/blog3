<?php
namespace common\models;

use yii\db\Query;
use yii\helpers\ArrayHelper;

class Conclusion extends generated\Conclusion
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
                'on'  => 'edit'
            ],
        ]);
    }


    public static function date($day)
    {
        return date('Y-m-d', strtotime($day));
    }

    public static function day(Query $query, $day)
    {
        $query
            ->andWhere('report_date >= :day')
            ->andWhere('report_date < :nexDay')
            ->params([
                ':day'    => static::date($day),
                ':nexDay' => static::date($day . ' +1 day')
            ]);

        return $query;
    }

}
