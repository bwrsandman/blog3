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

    public function actionIndex()
    {
        $currentDir  = getcwd();
        $splitScript = Yii::getAlias('@ext') . '/git-simple-split.sh';
        $upCmd       = 'git checkout master && git reset --hard && git pull';

        chmod($splitScript, 0776);
        foreach ($this->map as $prefix => $repo) {
            chdir($this->repoDir);
            $this->runCommand($upCmd);
            $cmd = $splitScript . ' ' . $prefix . ' ' . $repo;

            $this->runCommand($cmd);
        }

        chdir($currentDir);
    }

    protected function runCommand($command)
    {
        exec($command, $out);
        $this->echoPre("command: " . $command . "\n" . "Out: " . print_r($out, true));
    }

    protected function echoPre($str)
    {
        echo Html::tag('pre', $str);
    }
}