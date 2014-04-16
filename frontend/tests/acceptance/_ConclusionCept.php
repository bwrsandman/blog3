<?php
use \Codeception\TestCase;

$I = new \WebGuy\GoalsWriteSteps($scenario);

$I->wantTo('ensure that frontpage works');
$I->amOnPage('/?id=1');

$I->writeConclusion();

$I->waitForAutoSave();
$I->amOnPage('/');

$I->expect("conclusion will save after reload page");
$I->see($I->conclusionMsg, TodayPage::$conclusionEditor);
