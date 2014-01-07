<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class All extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $js = [
        'assets/build/all.js',
    ];
}
