<?php
namespace common\components;

use yii\base\Exception;
use yii\db\Expression;

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


    public static function date($day)
    {
        return date('Y-m-d', strtotime($day));
    }

    public function throwValidationErrors()
    {
        throw new Exception(json_encode($this->getErrors()));
    }

}