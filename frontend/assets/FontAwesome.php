<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class FontAwesome extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/js/components/components-font-awesome';

    public $css = array(
        'css/font-awesome.min.css',
    );
}
