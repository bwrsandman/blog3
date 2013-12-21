<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class JqueryUi extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/js/components/jquery-ui';

    public $js = array(
        'ui/minified/jquery-ui.min.js',
    );
}
