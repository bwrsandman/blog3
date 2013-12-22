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
    public $baseUrl = '@web/js/vendor/angular-ui-utils/modules';

    public $js = array(
        'scrollfix/scrollfix.js',
    );
}
