<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class AngularXeditable extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/js/components/angular-xeditable/dist';

    public $css = array(
        'css/xeditable.css',
    );
    public $js = array(
        'js/xeditable.js',
    );
}
