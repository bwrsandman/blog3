<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class AngularChosen extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web/src/vendor';

    public $js = array(
        'chosen/chosen.jquery.js',
        'angular-chosen-localytics/chosen.js',
    );
}
