<?php
namespace frontend\modules\gitHooks\controllers;

use yii\web\Controller;
use Yii;

class SubtreeUpdateController extends Controller {

    protected $repoDir = '/var/www/repos/eg';
    protected $map = [
        'extensions/yii2-html-encode-behavior' => 'git@github.com:nizsheanez/yii2-html-encode-behavior'
    ];

    public function actionIndex()
    {
        $splitScript = $this->repoDir . '/extensions/git-simple-split.sh';
        foreach ($this->map as $prefix => $repo) {
            $cmd = $splitScript . ' ' . $prefix . ' ' . $repo;
            var_dump(exec($cmd, $output));
            print_r($output);
        }
    }
}