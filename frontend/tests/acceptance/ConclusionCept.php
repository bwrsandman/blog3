<?php
use \Codeception\TestCase;

$I = new \WebGuy\GoalsWriteSteps($scenario);

$I->wantTo('ensure that frontpage works');
$I->amOnPage('/?id=1');

$I->writeConclusion();

$I->wait('1000');
$I->amOnPage('/');

$I->expect("conclusion will save after reload page");
$I->execute(function () use ($I) {
    TestCase::assertEquals($I->readConclusion(), $I->conclusionMsg);
});
