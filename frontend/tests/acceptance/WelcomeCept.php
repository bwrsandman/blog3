<?php
use \Codeception\TestCase;

$I = new \WebGuy\GoalsWriteSteps($scenario);

$I->wantTo('ensure that frontpage works');
$I->amOnPage('/?id=1');
for ($i = 0; $i < 10; $i++) {
    $I->writeReport($i);
    $I->writeReason($i);
}

$I->writeConclusion();

$I->wait('1200');
$I->amOnPage('/');

//reports
$I->expect("reports will save after reload page");
for ($i = 0; $i < 10; $i++) {
    $I->execute(function () use ($i, $I) {
        TestCase::assertEquals($I->readReport($i), $I->getMessage($i));
    });
}

$I->expect("reasons will visible after click on report");
for ($i = 0; $i < 10; $i++) {
    $I->execute(function () use ($i, $I) {
        $I->clickReport($i);
        TestCase::assertEquals($I->readReason(), $I->getMessage($i));
    });
}

$I->expect("reasons will visible after focus on report");
for ($i = 0; $i < 10; $i++) {
    $I->execute(function () use ($i, $I) {
        $I->focusReport($i);
        TestCase::assertEquals($I->readReason(), $I->getMessage($i));
    });
}

$I->expect("conclusion will save after reload page");
$I->execute(function () use ($i, $I) {
    //conclusion
    TestCase::assertEquals($I->readConclusion(), $I->conclusionMsg);
});
