<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class Angular extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web/js/vendor/';
	public $js = [
        'angular/angular.js',
        'angular-resource/angular-resource.min.js',
        'angular-route/angular-route.min.js',
//        'angular-ui-router/release/angular-ui-router.min.js',
        'angular-translate/angular-translate.js',
    ];
}
