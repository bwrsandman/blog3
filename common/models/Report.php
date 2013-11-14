<?php
namespace common\models;

use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

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
                'on'  => 'edit'
            ],
        ]);
    }

}
