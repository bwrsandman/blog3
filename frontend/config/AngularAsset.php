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
        'js/components/angular/angular.js',
//        'js/components/angular-bootstrap/ui-bootstrap.js',
//        'js/components/angular-bootstrap/ui-bootstrap-tpls.js',
        '//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.4.0/ui-bootstrap-tpls.min.js',
        'js/components/angular-ui-router/release/angular-ui-router.min.js',
//        'js/modules/angular-translate.min.js',
        'js/components/angular-translate/angular-translate.js',

        'js/modules/app.js',

        'js/modules/main/services/alert.js',
        'js/modules/main/controllers/root.js',

        'js/modules/map/services/places.js',
        'js/modules/map/controllers/list.js',
        'js/modules/map/controllers/form.js',
        'js/modules/map/directives/pg-google-map.js',
    );
}
