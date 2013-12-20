<?php
$I = new \WebGuy\GoalsWriteSteps($scenario);
$I->wantTo('ensure that goal working correct');

$I->amOnPage('/?id=1');

$I->expect("that i can to edit goal");

foreach($I->getGoals() as $id) {
    $msg = $I->message('goal_title', $id);
    $editField = TodayPage::goalTitle($id);
    $editBtn = TodayPage::goalEditButton($id);

    $I->clickEditButton($id);
    $I->write(TodayPage::$goalTitleEditor, $msg);
    $I->dontSee($msg, $editField);
    $I->clickCancel(TodayPage::$goalEditModal);
    $I->dontSee($msg, $editField);

    $I->clickEditButton($id);
    $I->write(TodayPage::$goalTitleEditor, $msg);
    $I->clickOk(TodayPage::$goalEditModal);
    $I->see($msg, $editField);
}

$I->expect("that i can to change goals category");

$I->seeGoalInCategory(1, TodayPage::PROFESSIONAL_ID);

$I->clickEditButton(1);
$I->selectOption(TodayPage::$goalTitleCategorySeletc, TodayPage::HEALTH_CAT);
$I->clickOk(TodayPage::$goalEditModal);

$I->seeGoalInCategory(1, TodayPage::HEALTH_ID);

$I->click(TodayPage::goalEditButton(1));
$I->selectOption(TodayPage::$goalTitleCategorySeletc, TodayPage::PROFESSIONAL_CAT);
$I->clickOk(TodayPage::$goalEditModal);

$I->seeGoalInCategory(1, TodayPage::PROFESSIONAL_ID);
