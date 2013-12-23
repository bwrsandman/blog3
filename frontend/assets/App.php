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
	public $baseUrl = '@web';
	public $css = array(
		'less/site.less',
    );

	public $js = array(
        'src/common/fixes.js',
        'src/common/debug.js',
//        'src/common/autobahn.js',
        'src/common/components.js',

        'src/app/app.js',

//        'src/app/goal/services/goalsIo.js',
        'src/app/goal/services/tpl.js',
        'src/app/goal/services/modal.js',
        'src/app/goal/services/user.js',
        'src/app/goal/services/category.js',
        'src/app/goal/services/goal.js',

        'src/app/goal/controllers/goal.js',
        'src/app/goal/controllers/nav.js',


        'src/app/goal/directives/editor.js',

        'src/app/goal/services/alert.js',
    );
	public $depends = array(
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
        'frontend\assets\Angular',
//        'frontend\assets\UiCodemirror',
        'frontend\assets\UiBootstrap',
        'frontend\assets\AngularElastic',
        'frontend\assets\AngularUiUtils',
        'frontend\assets\TextAngular',
        'frontend\assets\FontAwesome',
//        'nizsheanez\websocket\assetBundles\WebSocket',
    );
}
