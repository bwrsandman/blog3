<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class AngularUi extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web/src/vendor/';
	public $js = [
        'angular-ui/build/angular-ui.min.js',
        'angular-ui-sortable/src/sortable.js',
    ];
    public $css = [
        'angular-ui/build/angular-ui.min.css',
    ];
}
