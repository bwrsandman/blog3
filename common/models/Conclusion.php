<?php
namespace common\models;

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
}
