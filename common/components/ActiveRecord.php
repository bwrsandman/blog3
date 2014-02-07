<?php
namespace common\components;

use yii\base\Exception;
use yii\db\Expression;
use yii\db\Query;

class ActiveRecord extends \yii\db\ActiveRecord
{
	public $__mocked;
	
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

    public function throwValidationErrors()
    {
        $data = [
            'model' => $this->className(),
            'errors' => $this->getErrors(),
            'attributes' => $this->attributes,
            'session' => $_SESSION
        ];
        throw new Exception(json_encode($data));
    }

}