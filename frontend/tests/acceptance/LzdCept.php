<?php
use \Codeception\TestCase;

$I = new \WebGuy\GoalsWriteSteps($scenario);

$I->amOnPage('/?id=1');

$I->canSeeCheckboxIsChecked('#checkbox');
$I->uncheckOption('#checkbox');
$I->click('#submit');
$I->canSeeCheckboxIsChecked('#checkbox');
//$I->cantSeeCheckboxIsChecked('#checkbox');
