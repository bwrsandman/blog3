<?php
use \Codeception\TestCase;

$I = new \WebGuy\GoalsWriteSteps($scenario);

$I->wantTo('ensure that frontpage works');
$I->amOnPage('/?id=1');
$I->seeElement('#goals-grid');

foreach($I->getGoals() as $id) {
    $I->clickReport($id);
    $I->writeReason($id);
}

$I->waitForAutoSave();
$I->amOnPage('/?id=1');

$I->expect("reasons will visible after click on report");
foreach($I->getGoals() as $id) {
    $I->clickReport($id);
    $I->see($I->message('reason', $id), TodayPage::$reasonEditor);
}

$I->flushMessages();
$I->amOnPage('/?id=1');


foreach($I->getGoals() as $id) {
    $I->focusReport($id);
    $I->writeReason($id);
}

$I->waitForAutoSave();
$I->amOnPage('/');

//
//$I->expect("reasons will visible after focus on report");
//foreach($I->getGoals() as $id) {
//    $I->focusReport($id);
//    $I->see($I->message('reason', $id), TodayPage::$reasonEditor);
//}
