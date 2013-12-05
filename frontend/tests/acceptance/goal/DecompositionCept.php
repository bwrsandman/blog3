<?php
use \Codeception\TestCase;

$I = new \WebGuy\GoalsWriteSteps($scenario);

$I->wantTo('ensure that frontpage works');

//click
$I->amOnPage('/?id=1');
for ($i = 0; $i < 10; $i++) {
    $I->clickReport($i);
    $I->writeDecomposition($i);
}

$I->wait('1200');
$I->amOnPage('/?id=1');


$I->expect("Decompositions will visible after click on report");
for ($i = 0; $i < 10; $i++) {
    $I->clickReport($i);
    $I->seeInField(TodayPage::$decompositionEditor, $I->getMessage('decomposition', $i));
}

//focus
$I->flushMessages();
$I->amOnPage('/?id=1');

for ($i = 0; $i < 10; $i++) {
    $I->focusReport($i);
    $I->writeDecomposition($i);
}

$I->wait('1200');
$I->amOnPage('/');

$I->expect("Decompositions will visible after focus on report");
for ($i = 0; $i < 10; $i++) {
    $I->focusReport($i);
    $I->seeInField(TodayPage::$decompositionEditor, $I->getMessage('decomposition', $i));
}

