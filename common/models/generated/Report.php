<?php

namespace common\models\generated;

/**
 * This is the model class for table "report".
 *
 * @property integer $id
 * @property string $description
 * @property integer $fk_goal
 * @property integer $create_time
 * @property integer $update_time
 *
 * @property Goal $fkGoal
 */
class Report extends \common\components\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'report';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['fk_goal', 'required'],
			['description', 'string'],
			['fk_goal, create_time, update_time', 'integer']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'description' => 'Description',
			'fk_goal' => 'Fk Goal',
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
