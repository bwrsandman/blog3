<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class TextAngular extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/js/components/textAngular';

    public $js = array(
        'textAngular.js',
    );

    public $depends = array(
        'frontend\assets\AngularSanitize',
        'frontend\assets\FontAwesome',
    );
}
