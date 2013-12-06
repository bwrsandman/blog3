<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class Angular extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web/js/components/';
	public $js = array(
        'angular/angular.min.js',
        'angular-resource/angular-resource.min.js',
        'angular-route/angular-route.min.js',
//        'angular-ui-router/release/angular-ui-router.min.js',
        'angular-translate/angular-translate.min.js',
    );
}
