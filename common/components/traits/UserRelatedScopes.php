<?php
namespace common\components\traits;

use yii\db\ActiveQuery;

trait UserRelatedScopes {

    /**
     * @param $id
     *
     * @return ActiveQuery
     */
    public function owner($id)
    {
        $this
            ->andWhere('fk_user = :fk_user')
            ->addParams([
                ':fk_user' => $id,
            ]);

        return $this;
    }
}