<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class UiBootstrap extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web/js/components/angular-bootstrap';
    public $css = array(
    );

    public $js = array(
        'ui-bootstrap.min.js',
        'ui-bootstrap-tpls.min.js',
    );
}
