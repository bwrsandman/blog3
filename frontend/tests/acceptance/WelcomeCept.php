<?php
$I = new WebGuy($scenario);
$I->wantTo('ensure that frontpage works');
$I->amOnPage('/');
$I->see('Сделано за сегодня');
$randMessage = 'Hello'.rand(0, 99999999);
$I->wait(1000);
$I->see('111');
//$I->fillField('goal-detail:first textarea', $randMessage);
//$I->amOnPage('/');
//$I->see($randMessage);
