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

        $rightIp = in_array($_SERVER['REMOTE_ADDR'], $github_ips);
        $rightChildIp = $this->cidr_match($_SERVER['REMOTE_ADDR'], $github_cidrs);
        if(!$rightIp && !$rightChildIp) {
            throw new HttpException(404, 'Wrong IP access.');
        }

        return parent::beforeAction($action);
    }

    public function cidr_match($ip, $ranges)
    {
        $ranges = (array)$ranges;
        foreach($ranges as $range) {
            list($subnet, $mask) = explode('/', $range);
            if((ip2long($ip) & ~((1 << (32 - $mask)) - 1)) == ip2long($subnet)) {
                return true;
            }
        }
        return false;
    }

}