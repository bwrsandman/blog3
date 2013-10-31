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
NavBar::begin([
    'brandLabel' => 'My Company',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top top-navigation',
    ],
]);
$menuItems = array(
    ['label' => 'Home', 'url' => ['/site/index']],
    ['label' => 'About', 'url' => ['/site/about']],
    ['label' => 'Contact', 'url' => ['/site/contact']],
);
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = ['label' => 'Logout (' . Yii::$app->user->identity->username . ')', 'url' => ['/site/logout']];
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav pull-right'],
    'items' => $menuItems,
]);
NavBar::end();
?>

<div class="main-container " ng-controller='RootCtl'>
    <div>
        <alert ng-repeat="alert in alerts" type="alert.type" close="closeAlert($index)">{{alert.msg}}</alert>
    </div>
    <?php echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]); ?>
    <?php echo Alert::widget() ?>
    <div class="row">
        <ng-view/>
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
