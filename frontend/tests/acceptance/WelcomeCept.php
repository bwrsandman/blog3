<?php
$I = new WebGuy($scenario);
$I->wantTo('ensure that frontpage works');
$I->amOnPage('/?id=1');
$I->seeLink('Brand');

$messages = [];
for ($i = 0; $i < 10; $i++) {
    $messages[$i] = $i . ' Hello ' . date('Y-m-d') . ' ' . rand(0, 99999999);
    $field = TodayPage::reportDescription($i);
    $I->fillField($field, $messages[$i]);
}

$I->wait('1000');
$I->amOnPage('/');
$I->execute(function () use ($I, $messages) {
    for ($i = 0; $i < 10; $i++) {
        $field = TodayPage::reportDescription($i);
        $realValue = $I->grabValueFrom($field);
        \Codeception\TestCase::assertEquals($realValue, $messages[$i], 'Editor ' . $i . ' is not saved');
    }
});



