<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class App extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web/src/';
	public $css = array();

	public $js = array(
        'common/fixes.js',
        'common/debug.js',
        'common/autobahn.js',
        'common/components.js',

        'app/app.js',

//        'app/goal/services/goalsIo.js',
        'app/goal/services/server.js',
        'app/goal/services/tpl.js',
        'app/goal/services/autobahn.js',
        'app/goal/services/modal.js',
        'app/goal/services/user.js',
        'app/goal/services/category.js',
        'app/goal/services/goal.js',

        'app/goal/controllers/goal.js',
        'app/goal/controllers/nav.js',


        'app/goal/directives/editor.js',

        'app/goal/services/alert.js',
    );
	public $depends = array(
		'yii\web\YiiAsset',
//		'yii\bootstrap\BootstrapAsset',
        'frontend\assets\Angular',
//        'frontend\assets\UiCodemirror',
        'frontend\assets\UiBootstrap',
        'frontend\assets\AngularElastic',
        'frontend\assets\AngularUiUtils',
        'frontend\assets\TextAngular',
//        'frontend\assets\FontAwesome',
//        'nizsheanez\websocket\assetBundles\WebSocket',
    );
}
