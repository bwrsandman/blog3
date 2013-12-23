<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class AngularElastic extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web/src/vendor/angular-elastic';

    public $js = array(
        'elastic.js',
    );
}
