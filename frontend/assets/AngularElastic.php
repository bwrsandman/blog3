<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class AngularElastic extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web/js/vendor/angular-elastic';

    public $js = array(
        'elastic.js',
    );
}
