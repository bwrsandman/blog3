<?php
namespace WebGuy;

use TodayPage;
use \Codeception\TestCase;

class GoalsWriteSteps extends \WebGuy
{
    protected $messages = [];
    public $conclusionMsg;

    public function focus($el)
    {
        $I = $this;

        $I->executeJs('$("' . $el . '").focus()');
//        parent::focus($el);
    }

    public function fillField($field, $value)
    {
        $I = $this;

        $I->executeJs('$("' . $field . '").val("' . $value . '").change()');
//        parent::fillField($field, $value);
    }

    public function click($link, $context = null)
    {
        $I = $this;

        $I->executeJs('$("' . $link . '").click()');
//        parent::click($link, $context);
    }

    public function waitForAutoSave()
    {
        $I = $this;

        //selenium2 - 1000
        $I->wait(2);
    }

    public function seeInField($field, $value)
    {
        $I = $this;

        $realValue = $I->grabValueFrom($field);
        $I->execute(function () use ($realValue, $value) {
            TestCase::assertEquals($realValue, $value);
        });
//        parent::canSeeInField($field, $value);
    }

    public function flushMessages()
    {
        $this->messages = [];
        $this->conclusionMsg = null;
    }

    public function getMessage($namespace, $i)
    {
        if (!isset($this->messages[$namespace][$i])) {
            $this->messages[$namespace][$i] = $i . ' Hello ' . rand(0, 99999999);
        }

        return $this->messages[$namespace][$i];
    }


    function writeReport($i)
    {
        $I = $this;

        $field = TodayPage::reportDescription($i);
        $I->fillField($field, $this->getMessage('report', $i));
    }

    public function readReport($i)
    {
        $I = $this;

        $field = TodayPage::reportDescription($i);

//        $I->executeJs('return $("' . $field . '").val()');

//        return $I->grabValueFrom($field);
    }

    public function focusReport($i)
    {
        $I = $this;

        $I->focus(TodayPage::reportDescription($i));
    }


    public function clickReport($i)
    {
        $I = $this;

        $I->click(TodayPage::reportDescription($i));
    }

    function writeReason($i)
    {
        $I = $this;

        $I->fillField(TodayPage::$reasonEditor, $this->getMessage('reason', $i));
    }


    public function readReason()
    {
        $I = $this;

        return $I->grabValueFrom(TodayPage::$reasonEditor);
    }

    function writeDecomposition($i)
    {
        $I = $this;

        $I->fillField(TodayPage::$decompositionEditor, $this->getMessage('decomposition', $i));
    }

    public function readDecomposition()
    {
        $I = $this;

        return $I->grabValueFrom(TodayPage::$decompositionEditor);
    }

    function writeComments($i)
    {
        $I = $this;

        $I->fillField(TodayPage::$commentsEditor, $this->getMessage('comments', $i));
    }

    public function readComments()
    {
        $I = $this;

        return $I->grabValueFrom(TodayPage::$commentsEditor);
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