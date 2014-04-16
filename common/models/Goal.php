<?php
namespace common\models;

use PHPDaemon\Core\Daemon;
use yii\data\ArrayDataProvider;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use \Yii;

/**
 * Class Goal
 * @package common\models
 * @property $user
 */
class Goal extends generated\Goal
{
    use \common\traits\Date;

    const COMPLETED_YES = 1;
    const COMPLETED_NO  = 0;

    /**
     * @return GoalQuery|ActiveQuery|\yii\db\ActiveQueryInterface
     */
    public static function find()
    {
        return new GoalQuery(get_called_class());
    }

    public function search()
    {
        return new ArrayDataProvider;
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [
                [
//                    'id',
                    'completed'
                ],
                'safe',
                'on' => 'create'
            ],
            [
                ['title'],
                'string',
                'min' => 3,
                'max' => 1024,
                'on'  => 'create'
            ],
            [
                ['reason', 'decomposition', 'comments'],
                'string',
                'max' => 30000,
                'on'  => 'create'
            ],
            [
                [
                    'id',
                    'title',
                    'completed'
                ],
                'safe',
                'on' => 'update'
            ],
            [
                ['title'],
                'string',
                'min' => 3,
                'max' => 1024,
                'on'  => 'update'
            ],
            [
                ['reason', 'decomposition', 'comments'],
                'string',
                'max' => 30000,
                'on'  => 'update'
            ],
        ]);
    }

    public function transactions()
    {
        return [
            'create' => self::OP_INSERT,
            'edit'   => self::OP_INSERT | self::OP_UPDATE | self::OP_DELETE,
        ];
    }


    /**
     * @return Report
     */
    public function getReport($day)
    {
        $report = $this->hasOne(Report::className(), ['fk_goal' => 'id'])->day($day)->one();

        if (!$report) {
	        $report = $this->createReportByDay($day);
        }

        return $report;
    }

	public function createReportByDay($day)
	{
		$report              = $this->reportInstance();
		$report->scenario    = 'create';
		$report->fk_goal     = $this->id;
		$report->description = '<div>&nbsp;</div>';
		$report->report_date = $this->date($day);
		if (!$report->save()) {
			$report->throwValidationErrors();
		}

		return $report;
	}

	/**
	 * @return Report
	 */
	public function reportInstance()
	{
		return new Report();
	}

    public function setAttributes($values, $safeOnly = true)
    {
        parent::setAttributes($values, $safeOnly);
        $days = [
            'today',
            'yesterday'
        ];

	    foreach ($days as $day) {
            if (isset($values[$day]['report'])) {
                $this->getReport($day)->attributes = $values[$day]['report'];
            }
	    }
    }

	public function getFullData()
	{
		$res  = $this->toArray();

		$days = [
			'today',
			'yesterday'
		];
		foreach ($days as $day) {
			$res[$day] = [
				'report' => $this->getReport($day)->toArray(),
			];
		}

		return $res;
	}

	/**
	 * Relation
	 *
	 * @return array|null|\yii\db\ActiveRecord
	 */
	public function getUser()
	{
		return $this->getFkUser()->one();
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

trait GoalScopes
{
    use \common\traits\scopes\UserRelated;
    use \common\traits\scopes\Date;
}

class GoalQuery extends ActiveQuery
{
    use GoalScopes;
}


