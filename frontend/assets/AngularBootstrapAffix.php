<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class AngularBootstrapAffix extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/src/vendor/angular-bootstrap-affix';

    public $js = array(
        'src/affix.js',
    );
}
