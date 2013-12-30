<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class AngularUiUtils extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/src/vendor/angular-ui-utils/';

    public $js = array(
        'ui-utils.min.js',
    );
}
