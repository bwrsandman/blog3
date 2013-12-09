<?php
use \Codeception\TestCase;

$I = new \WebGuy\GoalsWriteSteps($scenario);

$I->wantTo('ensure that frontpage works');
$I->amOnPage('/?id=1');
for ($i = 0; $i < 10; $i++) {
    $I->clickReport($i);
    $I->writeReason($i);
}

$I->waitForAutoSave();
$I->amOnPage('/?id=1');

$I->expect("reasons will visible after click on report");
for ($i = 0; $i < 10; $i++) {
    $I->clickReport($i);
    $I->see($I->getMessage('reason', $i), TodayPage::$reasonEditor);
}

$I->flushMessages();
$I->amOnPage('/?id=1');

for ($i = 0; $i < 10; $i++) {
    $I->focusReport($i);
    $I->writeReason($i);
}

$I->waitForAutoSave();
$I->amOnPage('/');

$I->expect("reasons will visible after focus on report");
for ($i = 0; $i < 10; $i++) {
    $I->focusReport($i);
    $I->see($I->getMessage('reason', $i), TodayPage::$reasonEditor);
}

