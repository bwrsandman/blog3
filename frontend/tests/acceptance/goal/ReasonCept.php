<?php
use \Codeception\TestCase;

$I = new \WebGuy\GoalsWriteSteps($scenario);

$I->wantTo('ensure that frontpage works');
$I->amOnPage('/?id=1');
$I->seeElement('#goals-grid');
$I->clickGoal(1);

$I->see("1 Hello 73179876", TodayPage::$reasonEditor);

return;
foreach($I->getGoals() as $id) {
    $I->clickGoal($id);
    $I->writeReason($id);
}

$I->waitForAutoSave();
$I->amOnPage('/?id=1');

$I->expect("reasons will visible after click on report");
foreach($I->getGoals() as $id) {
    $I->clickGoal($id);
    $I->see($I->message('reason', $id), TodayPage::$reasonEditor);
}

/*
$I->flushMessages();
$I->amOnPage('/?id=1');


foreach($I->getGoals() as $id) {
    $I->focusGoal($id);
    $I->writeReason($id);
}

$I->waitForAutoSave();
$I->amOnPage('/');
*/

//
//$I->expect("reasons will visible after focus on report");
//foreach($I->getGoals() as $id) {
//    $I->focusGoal($id);
//    $I->see($I->message('reason', $id), TodayPage::$reasonEditor);
//}
