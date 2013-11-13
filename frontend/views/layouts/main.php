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
<html lang="en" ng-app="MainApp">
<head>
    <meta charset="<?php echo Yii::$app->charset; ?>"/>
    <title><?php echo Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>
<body>

<?php $this->beginBody(); ?>

<nav class="navbar navbar-default navbar-fixed-top test-navigation" role="navigation" ng-controller="NavigationCtrl">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li ng-class="{active: activeTab('') }">
                <a href="/">Today (22%)</a>
            </li>
            <li ng-class="{active: activeTab('yesterday') }">
                <a href="/yesterday">Yesterday (22%)</a>
            </li>
            <li ng-class="{active: activeTab('wall') }">
                <a href="/wall">Wall(social)</a>
            </li>
            <li class="divider"></li>
            <li ng-class="{active: activeTab('stream') }">
                <a href="/stream">All(social)</a>
            </li>
            <li class="divider"></li>
            <li ng-class="{active: activeTab('history') }">
                <a href="/history">History</a>
            </li>
        </ul>
        <form class="navbar-form navbar-right" role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</nav>
<div class="main-container">
    <div>
        <alert ng-repeat="alert in alerts" type="alert.type" close="closeAlert($index)">{{alert.msg}}</alert>
    </div>
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
