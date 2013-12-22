<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class AngularSanitize extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/js/vendor/angular-sanitize';

    public $js = array(
        'angular-sanitize.js',
    );
}
