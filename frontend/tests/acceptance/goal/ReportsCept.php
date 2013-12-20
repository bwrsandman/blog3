<?php

$I = new \WebGuy\GoalsWriteSteps($scenario);
$I->wantTo('ensure that goal reports panels working correct');

$I->amOnPage('/?id=1');

$I->expect("reports will save after reload page");
foreach($I->getGoals() as $id) {
    $I->writeReport($id);
}

$I->waitForAutoSave();
$I->amOnPage('/');

$I->expect("reports will save after reload page");
foreach($I->getGoals() as $id) {
    $I->see($I->message('report', $id), TodayPage::reportDescription($id));
}

$I->expect("on focus will see editing panel for this reason and don't see for another");
foreach($I->getGoals() as $id) {
    $I->focusReport($id);
    $I->canSeeElement(TodayPage::goalEditingPanel($id));
    foreach($I->getGoals() as $j) {
        if ($id != $j) {
            $I->cantSeeElement(TodayPage::goalEditingPanel($j));
        }
    }
}

