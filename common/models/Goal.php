<?php
namespace common\models;

use yii\db\ActiveRecord;

class Goal extends ActiveRecord
{
    public static function tableName()
    {
        return 'goal';
    }

    public function behaviors()
    {
        return array(
            'timestamp' => array(
                'class' => 'yii\behaviors\AutoTimestamp',
                'attributes' => array(
                    ActiveRecord::EVENT_BEFORE_INSERT => array('create_time', 'update_time'),
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
                ),
            ),
        );
    }

}
