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
        'js/bower_components/angular/angular.js',
//        'js/bower_components/angular-bootstrap/ui-bootstrap.js',
//        'js/bower_components/angular-bootstrap/ui-bootstrap-tpls.js',
        '//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.4.0/ui-bootstrap-tpls.min.js',
        'js/bower_components/angular-ui-router/release/angular-ui-router.min.js',
//        'js/angular-modules/angular-translate.min.js',
        'js/bower_components/angular-translate/angular-translate.js',
        'js/angular-modules/app/app.js',
        'js/angular-modules/app/services/places.js',
        'js/angular-modules/app/controllers/list.js',
        'js/angular-modules/app/controllers/form.js',
        'js/angular-modules/app/directives/pg-google-map.js',
    );
}
