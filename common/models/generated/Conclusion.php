<?php

namespace common\models\generated;

/**
 * This is the model class for table "conclusion".
 *
 * @property integer $id
 * @property string $create_time
 * @property string $description
 * @property integer $fk_user
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
			[['create_time', 'fk_user', 'report_date'], 'required'],
			[['create_time', 'update_time', 'report_date'], 'safe'],
			[['description'], 'string'],
			[['fk_user'], 'integer']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'create_time' => 'Create Time',
			'description' => 'Description',
			'fk_user' => 'Fk User',
			'update_time' => 'Update Time',
			'report_date' => 'Report Date',
		];
	}
}
