<?php
namespace common\models;

use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

class Goal extends generated\Goal
{

    protected $reportTodayCache;
    protected $reportYesterdayCache;

    public function search()
    {
        return new ArrayDataProvider;
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['id, title, completed', 'safe', 'on' => 'create'],
            ['title', 'string', 'min' => 3, 'max' => 1024, 'on' => 'create'],
            ['title, completed', 'safe', 'on' => 'edit'],
            ['title', 'string', 'min' => 3, 'max' => 1024, 'on' => 'edit'],
        ]);
    }

    public function transactions()
    {
        return [
            'create' => self::OP_INSERT,
            'edit' => self::OP_INSERT | self::OP_UPDATE | self::OP_DELETE,
        ];
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getReport()
    {
        return $this->hasOne(Report::className(), ['fk_goal' => 'id']);
    }

    public function today()
    {
        return date('Y-m-d', strtotime('today'));
    }

    public function yesterday()
    {
        return date('Y-m-d', strtotime('yesterday'));
    }

    /**
     * @return Report
     */
    public function getReportToday()
    {
        if ($this->reportTodayCache) {
            return $this->reportTodayCache;
        }
        $report = $this->getReport()
            ->andWhere('report_date >= :today')
            ->params([
                ':today' => $this->today(),
            ])->one();

        if (!$report) {
            $report = new Report();
            $report->scenario = 'create';
            $report->fk_goal = $this->id;
            $report->report_date = $this->today();
            if (!$report->save()) {
                $report->throwValidationErrors();
            }
        }
        return $this->reportTodayCache = $report;
    }

    /**
     * @return Report
     */
    public function getReportYesterday()
    {
        if ($this->reportYesterdayCache) {
            return $this->reportYesterdayCache;
        }
        $report = $this->getReport()
            ->andWhere('report_date >= :yesterday')
            ->andWhere('report_date < :today')
            ->params([
                ':today' => $this->today(),
                ':yesterday' => $this->yesterday()
            ])->one();

        if (!$report) {
            $report = new Report();
            $report->scenario = 'create';
            $report->fk_goal = $this->id;
            $report->report_date = $this->yesterday();
            if (!$report->save()) {
                $report->throwValidationErrors();
            }
        }
        return $this->reportYesterdayCache = $report;
    }

    public function setAttributes($values, $safeOnly = true)
    {
        if (isset($values['reportToday'])) {
            $this->reportToday->attributes = $values['reportToday'];
        }
        if (isset($values['reportYesterday'])) {
            $this->reportYesterday->attributes = $values['reportYesterday'];
        }
        return parent::setAttributes($values, $safeOnly);
    }

    public function toArray()
    {
        $res = parent::toArray();
        $res['reportToday'] = $this->reportToday->toArray();
        if ($this->reportYesterday) {
            $res['reportYesterday'] = $this->reportYesterday->toArray();
        }
        return $res;
    }

    public function beforeSave($event)
    {
        if (parent::beforeSave($event)) {
            $saved = $this->reportToday->save() && $this->reportYesterday->save();
            if (!$saved) {
                return false;
            }
        }
        return true;
    }
}
