<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\config;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web/js';
	public $css = array(
		'less/site.less',
    );

	public $js = array(
        'debug.js',
        'components.js',

//        'components/angular-bootstrap/ui-bootstrap.js',
//        'components/angular-bootstrap/ui-bootstrap-tpls.js',
//        'js/modules/angular-translate.min.js',

        'app/app.js',

        'app/main/services/goalsIo.js',
        'app/main/services/goalStorage.js',

        'app/main/controllers/goal.js',

        'app/main/services/alert.js',
        'app/main/controllers/root.js',
        'app/main/controllers/nav.js',
    );
	public $depends = array(
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
        'frontend\config\AngularAsset',
//        'frontend\config\UiCodemirrorAsset',
        'frontend\config\UiBootstrapAsset',
        'frontend\config\AngularElasticAsset',
        'nizsheanez\websocket\assetBundles\WebSocket',
	);
}
