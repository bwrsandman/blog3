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
//        '//maps.googleapis.com/maps/api/js?sensor=false',
        'js/components/angular/angular.js',
//        '//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.4.0/ui-bootstrap-tpls.min.js',
        'js/components/angular-route/angular-route.js',
        'js/components/angular-ui-router/release/angular-ui-router.min.js',
        'js/components/angular-translate/angular-translate.js',
    );
}
