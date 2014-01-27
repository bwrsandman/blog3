<?php
namespace common\traits;

trait Date
{

    public static function date($day)
    {
        return date('Y-m-d', strtotime($day));
    }

}