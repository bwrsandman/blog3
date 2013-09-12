<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\config;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AngularAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $js = array(
        '//maps.googleapis.com/maps/api/js?sensor=false',
        'js/angular/angular.js',
        'js/angular/ui-bootstrap-tpls-0.4.0.min.js',
        'js/angular/angular-translate.min.js',
        'js/angular/app/app.js',
        'js/angular/app/services/places.js',
        'js/angular/app/controllers/list.js',
        'js/angular/app/controllers/form.js',
        'js/angular/app/directives/pg-google-map.js',
    );
}
