<?php
namespace common\traits\scopes;

use yii\db\ActiveQuery;


/**
 * Class $this ActiveQuery
 */
trait UserRelated {

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