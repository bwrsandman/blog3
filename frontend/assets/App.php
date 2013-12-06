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

        'app/goal/controllers/goal.js',
        'app/goal/controllers/nav.js',

        'app/goal/directives/editor.js',

        'app/goal/services/alert.js',

    );
	public $depends = array(
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
        'frontend\assets\Angular',
//        'frontend\assets\UiCodemirror',
        'frontend\assets\UiBootstrap',
        'frontend\assets\AngularElastic',
	);
}
