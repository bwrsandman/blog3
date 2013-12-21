<?php
namespace common\models;

use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class Goal extends generated\Goal
{
    protected $reportsCache;

    const COMPLETED_YES = 1;
    const COMPLETED_NO = 0;

    public function search()
    {
        return new ArrayDataProvider;
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [
                [
                    'id',
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
        if (isset($this->reportsCache[$day])) {
            return $this->reportsCache[$day];
        }
        $report = $this->hasOne(Report::className(), ['fk_goal' => 'id'])->day($day)->one();

        if (!$report) {
            $report = new Report();
            $report->scenario = 'create';
            $report->fk_goal = $this->id;
            $report->description = '<div>&nbsp;</div>';
            $report->report_date = $this->date($day);
            if (!$report->save()) {
                $report->throwValidationErrors();
            }
        }

        return $this->reportsCache[$day] = $report;
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

    public function toArray()
    {
        $res = parent::toArray();
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

    public function afterSave($insert)
    {
        $this->getReport('today')->save() && $this->getReport('yesterday')->save();
        parent::afterSave($insert);
    }
}
