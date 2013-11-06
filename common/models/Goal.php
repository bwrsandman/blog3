<?php
namespace common\models;

use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;
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
            ['description', 'string', 'max' => 30000, 'on' => 'edit'],
        ]);
    }

    /**
     * @return Step
     */
    public function getSteps()
    {
        return $this->hasMany(Step::className(), ['fk_goal' => 'id']);
    }

}
