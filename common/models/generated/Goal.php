<?php

namespace common\models\generated;

/**
 * This is the model class for table "goal".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 * @property integer $completed
 * @property integer $fk_user
 * @property string $reason
 * @property string $create_time
 * @property string $update_time
 * @property string $decomposition
 * @property string $comments
 * @property integer $fk_goal_category
 *
 * @property GoalCategory $fkGoalCategory
 * @property User $fkUser
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
			[['title', 'completed', 'fk_user', 'fk_goal_category'], 'required'],
			[['status', 'completed', 'fk_user', 'fk_goal_category'], 'integer'],
			[['reason', 'decomposition', 'comments'], 'string'],
			[['create_time', 'update_time'], 'safe'],
			[['title'], 'string', 'max' => 255]
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
			'completed' => 'Completed',
			'fk_user' => 'Fk User',
			'reason' => 'Reason',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'decomposition' => 'Decomposition',
			'comments' => 'Comments',
			'fk_goal_category' => 'Fk Goal Category',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getFkGoalCategory()
	{
		return $this->hasOne(GoalCategory::className(), ['id' => 'fk_goal_category']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getFkUser()
	{
		return $this->hasOne(User::className(), ['id' => 'fk_user']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getReports()
	{
		return $this->hasMany(Report::className(), ['fk_goal' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSteps()
	{
		return $this->hasMany(Step::className(), ['fk_goal' => 'id']);
	}
}
