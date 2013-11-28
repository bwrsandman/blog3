<?php
use \Codeception\TestCase;

$I = new \WebGuy\GoalsWriteSteps($scenario);

$I->wantTo('ensure that frontpage works');
//$I->amOnPage('/?id=1');
//for ($i = 0; $i < 10; $i++) {
//    $I->clickReport($i);
//    $I->writeReason($i);
//}

//$I->wait('1100');
//$I->amOnPage('/?id=1');


//$I->expect("reasons will visible after click on report");
//for ($i = 0; $i < 10; $i++) {
//    $I->clickReport($i);
//    $I->execute(function () use ($i, $I) {
//        TestCase::assertEquals($I->readReason(), $I->getMessage($i));
//    });
//}

//$I->flushMessages();
$I->amOnPage('/?id=1');

for ($i = 0; $i < 10; $i++) {
    $I->focusReport($i);
    $I->writeReason($i);
    $I->readReason();
}

$I->wait('2100');
$I->amOnPage('/');

$I->expect("reasons will visible after focus on report");
for ($i = 0; $i < 10; $i++) {
    $I->execute(function () use ($i, $I) {
        $I->focusReport($i);
        file_put_contents('php://stdout', $I->readReason() ."\n");
        TestCase::assertEquals($I->readReason(), $I->getMessage($i));
    });
}

