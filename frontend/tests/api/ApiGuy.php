<?php
// This class was automatically generated by build task
// You should not change it manually as it will be overwritten on next build
// @codingStandardsIgnoreFile


use \Codeception\Maybe;
use Codeception\Module\ApiHelper;

/**
 * Inherited methods
 * @method void haveFriend($name)
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
*/

class ApiGuy extends \Codeception\AbstractGuy
{
    
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     *
     * @see Codeception\Module::getName()
     */
    public function getName() {
        return $this->scenario->runStep(new \Codeception\Step\Action('getName', func_get_args()));
    }
}

