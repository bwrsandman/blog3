<?php
namespace frontend\modules\gitHooks;

use yii\web\Controller;
use Yii;

class SubtreeUpdate extends Controller {

    protected $repoDir = '/var/repos/eg';
    protected $map = [
        'extensions/yii2-html-encode-behavior' => 'git@github.com:nizsheanez/yii2-html-encode-behavior'
    ];

    public function indexAction()
    {
        $root = Yii::getAlias('root');
        $splitScript = $root . '/extensions/git-simple-split.sh';
        system($splitScript);
    }
}