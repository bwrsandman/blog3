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
class UiCodemirrorAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
    public $css = array(
        'js/components/codemirror/lib/codemirror.css'
    );

    public $js = array(
        'js/components/codemirror/lib/codemirror.js',
        'js/components/angular-ui-codemirror/ui-codemirror.js'
    );
}
