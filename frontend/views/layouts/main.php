<?php
use frontend\config\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\widgets\Alert;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php echo Yii::$app->charset; ?>"/>
    <title><?php echo Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>
<body ng-app="MainApp">

<?php $this->beginBody(); ?>
<?php
NavBar::begin(array(
    'brandLabel' => 'My Company',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => array(
        'class' => 'navbar-inverse navbar-fixed-top top-navigation',
    ),
));
$menuItems = array(
    array('label' => 'Home', 'url' => array('/site/index')),
    array('label' => 'About', 'url' => array('/site/about')),
    array('label' => 'Contact', 'url' => array('/site/contact')),
);
if (Yii::$app->user->isGuest) {
    $menuItems[] = array('label' => 'Signup', 'url' => array('/site/signup'));
    $menuItems[] = array('label' => 'Login', 'url' => array('/site/login'));
} else {
    $menuItems[] = array('label' => 'Logout (' . Yii::$app->user->identity->username . ')', 'url' => array('/site/logout'));
}
echo Nav::widget(array(
    'options' => array('class' => 'navbar-nav pull-right'),
    'items' => $menuItems,
));
NavBar::end();
?>

<div class="main-container " ng-controller='RootCtl'>
    <div>
        <alert ng-repeat="alert in alerts" type="alert.type" close="closeAlert($index)">{{alert.msg}}</alert>
    </div>
    <?php echo Breadcrumbs::widget(array(
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : array(),
    )); ?>
    <?php echo Alert::widget() ?>
    <div class="row">
        <div class="navigation col-md-2">
            <ul class="nav nav-stacked">
                <li><a href="#">Goals</a></li>
                <li><a href="#">Account</a></li>
            </ul>
        </div>
        <div class="col-md-6 content-container">
            <ng-view/>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="">
        <p class="pull-left">&copy; My Company <?php echo date('Y'); ?></p>

        <p class="pull-right"><?php echo Yii::powered(); ?></p>
    </div>
</footer>

<div class="first-load"></div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
