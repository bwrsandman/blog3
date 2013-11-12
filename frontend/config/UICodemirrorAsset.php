<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\config;

use yii\web\AssetBundle;

class UiCodemirrorAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web/js/components/';
    public $css = array(
        'codemirror/lib/codemirror.css'
    );

    public $js = array(
        'codemirror/lib/codemirror.js',
        'angular-ui-codemirror/ui-codemirror.js'
    );
}
