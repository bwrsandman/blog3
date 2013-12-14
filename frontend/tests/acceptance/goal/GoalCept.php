<?php

$I = new \WebGuy\GoalsWriteSteps($scenario);
$I->wantTo('ensure that goal working correct');

$I->amOnPage('/?id=1');

$I->expect("that i can to edit goal");

for ($i = 0; $i < 10; $i++) {
    $I->click(TodayPage::goalEditButton());
    $I->seeElement(TodayPage::$goalEditModal);
    $I->write(TodayPage::$goalTitleEditor, $I->message('goal_edit_title', $i));
    $I->dontSee($I->message('goal_edit_title', $i), TodayPage::goalTitle($i));
    $I->click('Cancel', TodayPage::$goalEditModal);
    $I->dontSee($I->message('goal_edit_title', $i), TodayPage::goalTitle($i));

    $I->click(TodayPage::goalEditButton());
    $I->seeElement(TodayPage::$goalEditModal);
    $I->write(TodayPage::$goalTitleEditor, $I->message('goal_edit_title', $i));
    $I->click('OK', TodayPage::$goalEditModal);
    $I->see($I->message('goal_edit_title', $i), TodayPage::goalTitle($i));
}