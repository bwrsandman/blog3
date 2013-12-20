<?php
use \Codeception\TestCase;

$I = new \WebGuy\GoalsWriteSteps($scenario);

$I->wantTo('ensure that frontpage works');

//click
$I->amOnPage('/?id=1');
foreach($I->getGoals() as $id) {
    $I->clickReport($id);
    $I->writeDecomposition($id);
}

$I->waitForAutoSave();
$I->amOnPage('/?id=1');


$I->expect("Decompositions will visible after click on report");
foreach($I->getGoals() as $id) {
    $I->clickReport($id);
    $I->see($I->message('decomposition', $id), TodayPage::$decompositionEditor);
}

//focus
$I->flushMessages();
$I->amOnPage('/?id=1');

foreach($I->getGoals() as $id) {
    $I->focusReport($id);
    $I->writeDecomposition($id);
}

$I->waitForAutoSave();
$I->amOnPage('/');

$I->expect("Decompositions will visible after focus on report");
foreach($I->getGoals() as $id) {
    $I->focusReport($id);
    $I->see($I->message('decomposition', $id), TodayPage::$decompositionEditor);
}

