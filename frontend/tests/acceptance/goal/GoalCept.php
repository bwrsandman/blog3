<?php

$I = new \WebGuy\GoalsWriteSteps($scenario);
$I->wantTo('ensure that goal working correct');

$I->amOnPage('/?id=1');

$I->expect("that i can to edit goal");

for ($i = 0; $i < 10; $i++) {
    $msg = $I->message('goal_title', $i);
    $editField = TodayPage::goalTitle($i);
    $editBtn = TodayPage::goalEditButton($i);

    $I->click($editBtn);
    $I->seeElement(TodayPage::$goalEditModal);
    $I->write(TodayPage::$goalTitleEditor, $msg);
    $I->dontSee($msg, $editField);
    $I->click('Cancel', TodayPage::$goalEditModal);
    $I->dontSee($msg, $editField);

    $I->click($editBtn);
    $I->seeElement(TodayPage::$goalEditModal);
    $I->write(TodayPage::$goalTitleEditor, $msg);
    $I->click('OK', TodayPage::$goalEditModal);
    $I->see($msg, $editField);
}