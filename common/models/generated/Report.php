<?php

namespace common\models\generated;

/**
 * This is the model class for table "report".
 *
 * @property integer $id
 * @property string $description
 * @property integer $fk_goal
 * @property string $report_date
 * @property string $create_time
 * @property string $update_time
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
			[['description'], 'string'],
			[['fk_goal', 'report_date'], 'required'],
			[['fk_goal'], 'integer'],
			[['report_date', 'create_time', 'update_time'], 'safe']
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
			'report_date' => 'Report Date',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getFkGoal()
	{
		return $this->hasOne(Goal::className(), ['id' => 'fk_goal']);
	}
}
