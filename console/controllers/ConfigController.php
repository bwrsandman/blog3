<?php
namespace console\controllers;

use yii\web\Controller;
use Yii;

class ConfigController extends Controller {

    public function actionIndex()
    {
        $this->view->renderers['conf'] = Yii::createObject(array(
            'class' => 'common\components\twig\ViewRenderer'
        ));

        $config_dir = Yii::getAlias('@runtime/sphinx');
        $config_path = Yii::getAlias('@runtime/sphinx/sphinx.config');
        $sphinx_dir = 'D:\tools/sphinx';
        $config = $this->view->renderFile(Yii::getAlias('@common/config/sphinx.tpl.conf'), array(
            'conf_dir' => $config_dir,
            'sphinx_dir' => $sphinx_dir
        ));
        if (!is_dir($config_dir)) {
            mkdir($config_dir, 0777, true);
        }
        file_put_contents($config_path, $config);
        echo $config_path;
    }
}