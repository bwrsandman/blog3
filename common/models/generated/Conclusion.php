<?php

namespace common\models\generated;

/**
 * This is the model class for table "conclusion".
 *
 * @property integer $id
 * @property string $description
 * @property integer $fk_user
 * @property string $create_time
 * @property string $update_time
 * @property string $report_date
 */
class Conclusion extends \common\components\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'conclusion';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['description'], 'string'],
			[['fk_user', 'report_date'], 'required'],
			[['fk_user'], 'integer'],
			[['create_time', 'update_time', 'report_date'], 'safe']
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
			'fk_user' => 'Fk User',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'report_date' => 'Report Date',
		];
	}
}
