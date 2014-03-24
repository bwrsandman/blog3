<?php

$I = new \WebGuy\GoalsWriteSteps($scenario);
$I->wantTo('ensure that goal reports panels working correct');

$I->amOnPage('/?id=1');

$I->expect("reports will save after reload page");
foreach($I->getGoals() as $id) {
    $I->clickGoal($id);
    $I->writeReport($id);
}

$I->waitForAutoSave();
$I->amOnPage('/');

$I->expect("reports will save after reload page");
foreach($I->getGoals() as $id) {
    $I->focusGoal($id);
    $I->see($I->message('report', $id), TodayPage::$reportEditor);
}

$I->expect("on focus will see editing panel for this reason and don't see for another");
foreach($I->getGoals() as $id) {
    $I->focusGoal($id);
    $I->canSeeElement(TodayPage::goalEditingPanel($id));
    foreach($I->getGoals() as $j) {
        if ($id != $j) {
            $I->cantSeeElement(TodayPage::goalEditingPanel($j));
        }
    }
}

