<?php
namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRelation;
use yii\helpers\ArrayHelper;

class Report extends generated\Report
{
    public static function createQuery()
    {
        return new ReportQuery(['modelClass' => get_called_class()]);
    }


    public static function createRelation($config = [])
    {
        return new ReportRelation($config);
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'htmlEncode' => [
                'class'      => 'common\components\behaviors\HtmlEncode',
                'attributes' => [
                    'description',
                ],
            ],
        ]);
    }

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
                'on'  => 'update'
            ],
        ]);
    }

	public function beforeValidate()
	{
		$this->stripTags('description');

		return parent::beforeValidate();
	}

    public function stripTags($attr, $allowableTags = null)
    {
	    if ($allowableTags === null) {
		    $allowableTags = '<input><div><ul><ol><li><a><img><b><em><br>';
	    }
        $this->$attr = strip_tags($this->$attr, $allowableTags);

        return true;
    }

}

trait ReportScopes
{
    use \common\traits\scopes\Date;
}

class ReportQuery extends ActiveQuery
{
    use ReportScopes;
}

class ReportRelation extends ActiveRelation
{
    use ReportScopes;
}
