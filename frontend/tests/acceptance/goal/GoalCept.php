<?php
$I = new \WebGuy\GoalsWriteSteps($scenario);
$I->wantTo('ensure that goal working correct');

$I->amOnPage('/?id=1');

$I->expect("that i can to edit goal");

foreach ($I->getGoals() as $id) {
    $msg = $I->message('goal_title', $id);
    $editField = TodayPage::goalTitle($id);
    $editBtn = TodayPage::goalEditButton($id);

    $I->clickEditGoalButton($id);
    $I->write(TodayPage::$goalTitleEditor, $msg);
    $I->dontSee($msg, $editField);
    $I->clickCancel(TodayPage::$goalEditModal);
    $I->dontSee($msg, $editField);

    $I->clickEditGoalButton($id);
    $I->write(TodayPage::$goalTitleEditor, $msg);
    $I->clickOk(TodayPage::$goalEditModal);
    $I->see($msg, $editField);
}

$I->expect("that i can to change goals category");

$I->seeGoalInCategory(1, TodayPage::PROFESSIONAL_ID);

$I->clickEditGoalButton(1);
$I->selectOption(TodayPage::$goalTitleCategorySelect, TodayPage::HEALTH_CAT);
$I->clickOk(TodayPage::$goalEditModal);

$I->seeGoalInCategory(1, TodayPage::HEALTH_ID);

$I->clickEditGoalButton(1);
$I->selectOption(TodayPage::$goalTitleCategorySelect, TodayPage::PROFESSIONAL_CAT);
$I->clickOk(TodayPage::$goalEditModal);

$I->seeGoalInCategory(1, TodayPage::PROFESSIONAL_ID);

$I->expect("that i can to add goals in category");

foreach ($I->getCategories() as $id => $name) {
    $msg = $I->message('goal_title', $id . '_new');

    $I->clickAddGoalButton($id);
    $I->write(TodayPage::$goalTitleEditor, $msg);
    $I->clickOk(TodayPage::$goalAddModal);

    $I->checkGoalIsInPlans($msg, $id);
}

$I->expect("that i can to complete goal");

$msg = $I->grabTextFrom(TodayPage::goalTitle(1));
$I->clickCompleteGoalButton(1);
$I->checkGoalIsDone($msg, 1);
