<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class ProductionApp extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = array();

	public $js = array(
        'src/vendor/jquery/dist/jquery.min.js',
        'src/vendor/angular/angular.min.js',
        'src/vendor/jquery-ui/ui/minified/jquery-ui.min.js',
        'assets/build/all.js',
    );

	public $depends = array(
//		'yii\web\YiiAsset',
//        'frontend\assets\Angular',
//        'frontend\assets\UiBootstrap',
//        'frontend\assets\AngularElastic',
//        'frontend\assets\AngularUiUtils',
//        'frontend\assets\TextAngular',
    );
}
