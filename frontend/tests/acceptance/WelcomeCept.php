<?php
$I = new WebGuy($scenario);
$I->wantTo('ensure that frontpage works');
$I->amOnPage('/?id=1');
$I->seeLink('Brand');

$messages = $reasonMsg = [];
for ($i = 0; $i < 10; $i++) {
    //report
    $messages[$i] = $i . ' Hello ' . rand(0, 99999999);
    $field = TodayPage::reportDescription($i);
    $I->fillField($field, $messages[$i]);

    //reason
    $I->focus($field);
    $I->fillField(TodayPage::$reasonEditor, $messages[$i]);
    $I->executeJs('$("' . TodayPage::$reasonEditor . '").keyup()');
}

//conclusion
$conclusionMsg = $i . ' Hello ' . rand(0, 99999999);
$I->fillField(TodayPage::$conclusionEditor, $conclusionMsg);

$I->wait('1000');

$I->amOnPage('/');

$I->execute(function () use ($I, $messages, $conclusionMsg) {
    for ($i = 0; $i < 10; $i++) {
        //reports
        $field = TodayPage::reportDescription($i);
        $realValue = $I->grabValueFrom($field);
        \Codeception\TestCase::assertEquals($realValue, $messages[$i], "Report " . $i . " didn't save");

        //reasons
        $I->focus($field);
        $realValue = $I->grabValueFrom(TodayPage::$reasonEditor);
        \Codeception\TestCase::assertEquals($realValue, $messages[$i], "Reason " . $i . " didn't save");
    }

    //conclusion
    $realValue = $I->grabValueFrom(TodayPage::$conclusionEditor);
    \Codeception\TestCase::assertEquals($realValue, $conclusionMsg, "Conclusion Editor didn't save");
});

