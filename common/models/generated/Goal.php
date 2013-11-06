<?php

namespace common\models\generated;

/**
 * This is the model class for table "goal".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $completed
 * @property string $description
 *
 * @property Report[] $reports
 * @property Step[] $steps
 */
class Goal extends \common\components\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'goal';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['title, create_time, update_time, completed, description', 'required'],
			['status, create_time, update_time, completed', 'integer'],
			['description', 'string'],
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
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'completed' => 'Completed',
			'description' => 'Description',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getReports()
	{
		return $this->hasMany(Report::className(), ['fk_goal' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getSteps()
	{
		return $this->hasMany(Step::className(), ['fk_goal' => 'id']);
	}
}
