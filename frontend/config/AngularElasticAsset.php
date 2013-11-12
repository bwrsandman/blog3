<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\config;

use yii\web\AssetBundle;

class AngularElasticAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';

    public $js = array(
        'js/components/angular-elastic/elastic.js',
    );
}
