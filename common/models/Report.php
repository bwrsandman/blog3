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

    public static function createActiveRelation($config = [])
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
            [
                ['description'],
                'strip'
            ]
        ]);
    }

    public function strip($attr)
    {
        $this->$attr = strip_tags($this->$attr, '<input><div><ul><ol><li><a><img><b><em><br>');

        return true;
    }

}

trait ReportScopes
{
    use \common\components\traits\DateScopes;
}

class ReportQuery extends ActiveQuery
{
    use ReportScopes;
}

class ReportRelation extends ActiveRelation
{
    use ReportScopes;
}
