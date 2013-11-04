<?php
namespace common\models;

use yii\data\ArrayDataProvider;
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

    public function search()
    {
        return new ArrayDataProvider;
    }

    public function rules() {
        return [
            ['id, title, completed', 'safe', 'on' => 'create'],
            ['title', 'string', 'min' => 3, 'max' => 1024, 'on' => 'create'],
            ['title, completed', 'safe', 'on' => 'edit'],
            ['title', 'string', 'min' => 3, 'max' => 1024, 'on' => 'edit'],
            ['description', 'string', 'max' => 30000, 'on' => 'edit'],
        ];
    }

    public function afterFind() {
        parent::afterFind();
        $this->completed = (bool)$this->completed;
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getSteps()
    {
        return $this->hasMany(Step::className(), ['fk_goal' => 'id']);
    }

}
