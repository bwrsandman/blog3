<?php
use yii\helpers\Html;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
if (YII_DEBUG) {
    frontend\assets\App::register($this);
} else {
    frontend\assets\ProductionApp::register($this);
}
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en" ng-app="eg.goal">
<head>
    <meta charset="utf-8"/>
    <title><?php echo Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
    <link href="/assets/build/css/site.css" rel="stylesheet">
</head>
<body>

<?php $this->beginBody(); ?>

<!--<nav class="navbar navbar-default test-navigation" role="navigation" ng-controller="NavigationCtrl">-->
<!--    <div class="container">-->
<!--        <div class="navbar-header">-->
<!--            <a class="navbar-brand" href="#">Brand</a>-->
<!--        </div>-->
<!--        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">-->
<!--            <ul class="nav navbar-nav">-->
<!--                <li ng-class="{active: activeTab('') }">-->
<!--                    <a href="/">Today (22%)</a>-->
<!--                </li>-->
<!--                <li ng-class="{active: activeTab('yesterday') }">-->
<!--                    <a href="/yesterday">Yesterday (22%)</a>-->
<!--                </li>-->
<!--                <li ng-class="{active: activeTab('wall') }">-->
<!--                    <a href="/wall">Wall(social)</a>-->
<!--                </li>-->
<!--                <li class="divider"></li>-->
<!--                <li ng-class="{active: activeTab('stream') }">-->
<!--                    <a href="/stream">All(social)</a>-->
<!--                </li>-->
<!--                <li class="divider"></li>-->
<!--                <li ng-class="{active: activeTab('history') }">-->
<!--                    <a href="/history">History</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <form class="navbar-form navbar-right" role="search">-->
<!--                <div class="form-group">-->
<!--                    <input type="text" class="form-control" placeholder="Search">-->
<!--                </div>-->
<!--                <button type="submit" class="btn btn-default">Submit</button>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</nav>-->
<div class="main-container ">
    <div class="container">
        <div>
            <alert ng-repeat="alert in alerts" type="alert.type" close="closeAlert($index)">{{alert.msg}}</alert>
        </div>
        <ng-view/>
    </div>
</div>
<!--<footer class="footer">-->
<!--    <div class="">-->
<!--        <p class="pull-left">&copy; My Company --><?php //echo date('Y'); ?><!--</p>-->
<!---->
<!--        <p class="pull-right">--><?php //echo Yii::powered(); ?><!--</p>-->
<!--    </div>-->
<!--</footer>-->

<!--<div class="first-load"></div>-->
<script>
    storage =
    <?=json_encode($this->context->clientStorage) ?>
</script>
<?php $this->endBody(); ?>

<?php if (YII_DEBUG) { ?>
    <script src="//<?=$_SERVER['HTTP_HOST'] ?>:35729/livereload.js"></script>
<?php } ?>

</body>
</html>
<?php $this->endPage(); ?>
