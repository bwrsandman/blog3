<?php
namespace WebGuy;

use TodayPage;

class GoalsWriteSteps extends \WebGuy
{
    protected $messages = [];
    public $conclusionMsg;

    public function getMessage($i)
    {
        if (!isset($this->messages[$i])) {
            $this->messages[$i] = $i . ' Hello ' . rand(0, 99999999);
        }

        return $this->messages[$i];
    }


    function writeReport($i)
    {
        $I = $this;

        $field = TodayPage::reportDescription($i);
        $I->fillField($field, $this->getMessage($i));
    }

    public function readReport($i)
    {
        $I = $this;

        $field = TodayPage::reportDescription($i);

        return $I->grabValueFrom($field);
    }

    function writeReason($i)
    {
        $I = $this;

        $field = TodayPage::reportDescription($i);
        $I->focus($field);
        $I->fillField(TodayPage::$reasonEditor, $this->messages[$i]);
        $I->executeJs('$("' . TodayPage::$reasonEditor . '").keyup()');
    }

    public function clickReport($i)
    {
        $I = $this;

        $I->click(TodayPage::reportDescription($i));
    }

    public function readReason()
    {
        $I = $this;

        return $I->grabValueFrom(TodayPage::$reasonEditor);
    }

    public function focusReport($i)
    {
        $I = $this;

        $I->focus(TodayPage::reportDescription($i));
    }


    function writeConclusion()
    {
        $I = $this;

        $this->conclusionMsg = 'Hello ' . rand(0, 99999999);
        $I->fillField(TodayPage::$conclusionEditor, $this->conclusionMsg);
    }


    function readConclusion()
    {
        $I = $this;

        return $I->grabValueFrom(TodayPage::$conclusionEditor);
    }

}