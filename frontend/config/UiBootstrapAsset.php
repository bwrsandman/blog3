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
class UiBootstrapAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web/js/components/angular-bootstrap';
    public $css = array(
    );

    public $js = array(
        'ui-bootstrap.min.js',
        'ui-bootstrap-tpls.min.js'
    );
}
