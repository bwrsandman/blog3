<?php
namespace common\components;

use yii\base\Exception;
use yii\db\Expression;
use yii\db\Query;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\AutoTimestamp',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => [
                        'create_time',
                        'update_time'
                    ],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
                ],
                'timestamp' => new Expression('NOW()')
            ],
        ];
    }

    /**
     * @param Query $query
     * @param $id
     *
     * @return Query
     * @return Query
     */
    public static function owner(Query $query, $id)
    {
        $query
            ->andWhere('fk_user = :fk_user')
            ->addParams([
                ':fk_user' => $id,
            ]);

        return $query;
    }

    public static function date($day)
    {
        return date('Y-m-d', strtotime($day));
    }

    public function throwValidationErrors()
    {
        throw new Exception(json_encode($this->getErrors()));
    }

}