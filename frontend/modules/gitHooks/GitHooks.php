<?php
namespace frontend\modules\gitHooks;

use yii\base\Module;
use Yii;
use yii\web\HttpException;

class GitHooks extends Module
{

    public function beforeAction($action)
    {
        $github_ips = array('207.97.227.253', '50.57.128.197', '108.171.174.178', '50.57.231.61');
        $github_cidrs = array('204.232.175.64/27', '192.30.252.0/22');
        if(!in_array($_SERVER['REMOTE_ADDR'], $github_ips) || cidr_match($_SERVER['REMOTE_ADDR'], $github_cidrs)) {
//            throw new HttpException(404, 'Wrong IP access.');
        }

        return parent::beforeAction($action);
    }

}