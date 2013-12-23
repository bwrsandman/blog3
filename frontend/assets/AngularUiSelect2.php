<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class AngularUiSelect2 extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web/src/vendor';

    public $css = array(
        'select2/select2.css',
    );

    public $js = array(
        'select2/select2.js',
        'angular-ui-select2/src/select2.js',
    );
}
