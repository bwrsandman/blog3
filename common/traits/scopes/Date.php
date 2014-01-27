<?php
namespace common\traits\scopes;
trait Date {

    use \common\traits\Date;

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