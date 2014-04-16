<?php
namespace common\models;

use yii\helpers\ArrayHelper;
use yii\db\ActiveQuery;

class Conclusion extends generated\Conclusion
{

    public static function find()
    {
        return new ConclusionQuery(get_called_class());
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
                ['id'],
                'safe',
                'on' => 'update'
            ],
            [
                ['description'],
                'string',
                'max' => 30000,
                'on'  => 'update'
            ],
        ]);
    }
}

trait ConclusionScopes {
    use \common\traits\scopes\UserRelated;
    use \common\traits\scopes\Date;
}

class ConclusionQuery extends ActiveQuery
{
    use ConclusionScopes;
}

