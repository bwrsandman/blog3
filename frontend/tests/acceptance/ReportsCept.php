<?php
use \Codeception\TestCase;

$I = new \WebGuy\GoalsWriteSteps($scenario);

$I->wantTo('ensure that frontpage works');
$I->amOnPage('/?id=1');
for ($i = 0; $i < 10; $i++) {
    $I->writeReport($i);
}

$I->wait('1000');
$I->amOnPage('/');

$I->expect("reports will save after reload page");
for ($i = 0; $i < 10; $i++) {
    $I->execute(function () use ($i, $I) {
        TestCase::assertEquals($I->readReport($i), $I->getMessage($i));
    });
}

