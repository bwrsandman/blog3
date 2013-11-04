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
class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = array(
		'less/site.less',
    );

	public $js = array(
        'js/debug.js',
        'js/components.js',

//        'components/angular-bootstrap/ui-bootstrap.js',
//        'components/angular-bootstrap/ui-bootstrap-tpls.js',
//        'js/modules/angular-translate.min.js',

        'js/modules/app.js',

        'js/modules/main/services/goalsIo.js',
        'js/modules/main/services/goalStorage.js',

        'js/modules/main/controllers/goal.js',

        'js/modules/main/services/alert.js',
        'js/modules/main/controllers/root.js',

//        'js/modules/map/services/places.js',
//        'js/modules/map/controllers/list.js',
//        'js/modules/map/controllers/form.js',
//        'js/modules/map/directives/pg-google-map.js',
    );
	public $depends = array(
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
        'frontend\config\AngularAsset',
//        'frontend\config\UiCodemirrorAsset',
        'frontend\config\UiBootstrapAsset',
        'frontend\config\AngularElasticAsset',
        'nizsheanez\components\assetBundles\WebSocket',
	);
}
