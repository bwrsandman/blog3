<?php
namespace common\components\traits;

trait DateScopes {

    public static function date($day)
    {
        return date('Y-m-d', strtotime($day));
    }

    public function day($day)
    {
        $this
            ->andWhere('report_date >= :day')
            ->andWhere('report_date < :nexDay')
            ->addParams([
                ':day'    => static::date($day),
                ':nexDay' => static::date($day . ' +1 day')
            ]);

        return $this;
    }
}