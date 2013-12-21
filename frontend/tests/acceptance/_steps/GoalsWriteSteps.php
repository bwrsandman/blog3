<?php
namespace WebGuy;

use TodayPage;
use \Codeception\TestCase;

class GoalsWriteSteps extends BaseSteps
{
    public $conclusionMsg;

    public function getGoals()
    {
        return range(1, 10);
    }

    public function getCategories()
    {
        return [
            TodayPage::PROFESSIONAL_ID => TodayPage::PROFESSIONAL_CAT,
            TodayPage::HEALTH_ID       => TodayPage::HEALTH_CAT,
            TodayPage::OWN_ID          => TodayPage::OWN_CAT,
            TodayPage::GLOBAL_ID       => TodayPage::GLOBAL_CAT,
        ];
    }


    public function seeGoalInCategory($goal, $category)
    {
        $I = $this;

        $I->seeElement(TodayPage::goalInCategory($goal, $category));
    }


    function writeReport($i)
    {
        $I = $this;

        $field = TodayPage::reportDescription($i);
        $I->write($field, $this->message('report', $i));
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

        $I->write(TodayPage::$reasonEditor, $this->message('reason', $i));
    }

    function writeDecomposition($i)
    {
        $I = $this;

        $I->write(TodayPage::$decompositionEditor, $this->message('decomposition', $i));
    }

    function writeComments($i)
    {
        $I = $this;

        $I->write(TodayPage::$commentsEditor, $this->message('comments', $i));
    }

    function writeConclusion()
    {
        $I = $this;

        $this->conclusionMsg = 'Hello ' . rand(0, 99999999);
        $I->write(TodayPage::$conclusionEditor, $this->conclusionMsg);
    }

    public function clickEditGoalButton($goal)
    {
        $I = $this;

        $I->click(TodayPage::goalEditButton($goal));
        $I->seeElement(TodayPage::$goalEditModal);
    }

    public function clickAddGoalButton($category)
    {
        $I = $this;

        $I->click(TodayPage::goalAddButton($category));
        $I->seeElement(TodayPage::$goalAddModal);
    }

}