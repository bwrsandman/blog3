<?php

namespace common\models\generated;

/**
 * This is the model class for table "step".
 *
 * @property integer $id
 * @property string $title
 * @property integer $fk_goal
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 *
 * @property Goal $fkGoal
 */
class Step extends \common\components\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'step';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['title, fk_goal, create_time, update_time', 'required'],
			['fk_goal, status, create_time, update_time', 'integer'],
			['title', 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Title',
			'fk_goal' => 'Fk Goal',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getFkGoal()
	{
		return $this->hasOne(Goal::className(), ['id' => 'fk_goal']);
	}
}
