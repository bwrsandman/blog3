<?php

$I = new \WebGuy\GoalsWriteSteps($scenario);

$I->wantTo('ensure that frontpage works');
$I->amOnPage('/?id=1');
for ($i = 0; $i < 10; $i++) {
    $I->writeReport($i);
}

$I->wait('1200');
$I->amOnPage('/');

$I->expect("reports will save after reload page");
for ($i = 0; $i < 10; $i++) {
    $I->seeInField(TodayPage::reportDescription($i), $I->getMessage('report', $i));
}

