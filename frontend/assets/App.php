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
	public $basePath = '@webroot/src/';
	public $baseUrl = '@web/src/';
	public $css = [
        'less/site.less'
    ];

	public $js = array(
        'common/fixes.js',
        'common/debug.js',
        'common/components.js',

        'app/app.js',

//        'app/goal/services/goalsIo.js',
        'app/goal/services/tpl.js',
        'app/goal/services/modal.js',
        'app/goal/services/user.js',
        'app/goal/services/category.js',
        'app/goal/services/report.js',
        'app/goal/services/goal.js',

        'app/goal/controllers/goal.js',
        'app/goal/controllers/nav.js',


        'app/goal/directives/editor.js',

        'app/goal/services/alert.js',
    );

	public $depends = array(
		'frontend\assets\Jquery',
//		'frontend\assets\JqueryUi',
//		'yii\bootstrap\BootstrapAsset',
        'frontend\assets\Angular',
        'frontend\assets\AngularUi',
//        'frontend\assets\UiCodemirror',
        'frontend\assets\UiBootstrap',
        'frontend\assets\AngularElastic',
        'frontend\assets\AngularUiUtils',
        'frontend\assets\TextAngular',
//        'frontend\assets\FontAwesome',
        'nizsheanez\wamp\assets\Bundle',
    );
}
