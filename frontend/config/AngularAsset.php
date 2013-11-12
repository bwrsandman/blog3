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
	public $baseUrl = '@web/js/components/';
	public $js = array(
//        '//maps.googleapis.com/maps/api/js?sensor=false',
        'angular/angular.js',
//        '//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.4.0/ui-bootstrap-tpls.min.js',
        'angular-route/angular-route.js',
//        'angular-ui-router/release/angular-ui-router.min.js',
        'angular-translate/angular-translate.js',
    );
}
