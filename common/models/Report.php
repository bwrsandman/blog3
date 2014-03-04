<?php
namespace common\models;

use Behat\Mink\Exception\Exception;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * Class Report
 * @package common\models
 * @property $goal
 */
class Report extends generated\Report
{
    public static function createQuery($config = [])
    {
        return new ReportQuery(['modelClass' => get_called_class()]);
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


	/**
	 * @return \yii\db\  ActiveQuery
	 */
	public function getFkGoal()
	{
		return $this->hasOne(Goal::className(), ['id' => 'fk_goal']);
	}

	public function getGoal()
	{
		return $this->getFkGoal()->one();
	}

	public function checkUserPermissions()
	{
		return $this->goal->user->id == Yii::$app->user->id;
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

