<?php
namespace frontend\modules\gitHooks\controllers;

use yii\helpers\Html;
use yii\web\Controller;
use Yii;

class SubtreeUpdateController extends Controller
{

    protected $repoDir = '/var/www/repos/eg';
    protected $binDir = '/var/www/bin';
    protected $map = [
        'extensions/yii2-html-encode-behavior' => 'git@github.com:nizsheanez/yii2-html-encode-behavior'
    ];

    public function beforeAction($action)
    {
        return true;
    }

    public function actionIndex()
    {
        $currentDir  = getcwd();
        $splitScript = Yii::getAlias('@ext') . '/git-simple-split.sh';

        chmod($splitScript, 0777);
        foreach ($this->map as $prefix => $repo) {
            chdir($this->repoDir);
            $this->runCommand('git checkout master');
            $this->runCommand('git reset --hard');
            $this->runCommand('git pull');

            $cmd = $splitScript . ' ' . $prefix . ' ' . $repo . ' --branches "master"';

            $this->runCommand($cmd);
        }

        chdir($currentDir);
    }

    protected function runCommand($command)
    {
        ob_start();
        system($command);
        $this->echoPre("command: " . $command . "\n" . "StdOut: " . ob_get_clean());
    }

    protected function echoPre($str)
    {
        echo Html::tag('pre', $str);
    }
}