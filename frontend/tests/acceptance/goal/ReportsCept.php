<?php

$I = new \WebGuy\GoalsWriteSteps($scenario);
$I->wantTo('ensure that goal reports panels working correct');

$I->amOnPage('/?id=1');

$I->expect("reports will save after reload page");
for ($i = 0; $i < 10; $i++) {
    $I->writeReport($i);
}

$I->waitForAutoSave();
$I->amOnPage('/');

$I->expect("reports will save after reload page");
for ($i = 0; $i < 10; $i++) {
    $I->see($I->getMessage('report', $i), TodayPage::reportDescription($i));
}

$I->expect("on focus will see editing panel for this reason and don't see for another");
for ($i = 0; $i < 10; $i++) {
    $I->focusReport($i);
    $I->canSeeElement(TodayPage::goalEditingPanel($i));
    for ($j = 0; $j < 10; $j++) {
        if ($i != $j) {
            $I->cantSeeElement(TodayPage::goalEditingPanel($j));
        }
    }
}
