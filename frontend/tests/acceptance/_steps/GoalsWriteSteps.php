<?php
namespace WebGuy;

use TodayPage;
use \Codeception\TestCase;
use yii\test\FixtureTrait;

class GoalsWriteSteps extends BaseSteps
{
    use FixtureTrait;

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

        $I->waitForElement(TodayPage::goalInCategory($goal, $category), 1);
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
        $I->waitForElement(TodayPage::$goalEditModal, 1);
    }

    public function clickAddGoalButton($category)
    {
        $I = $this;

        $I->click(TodayPage::goalAddButton($category));
        $I->waitForElement(TodayPage::$goalAddModal, 1);
    }


    public function clickBackLogButton($category)
    {
        $I = $this;

        $I->click(TodayPage::goalBackLogButton($category));
        $I->waitForElement(TodayPage::$goalBackLogModal, 1);
    }

    public function clickCompleteGoalButton($goal)
    {
        $I = $this;

        $I->click(TodayPage::goalCompleteButton($goal));
    }

    public function checkGoalIsDone($title, $categoryId)
    {
        $I = $this;

        $I->dontSee($title, '#goal_grid');

        $I->clickBackLogButton($categoryId);

        $I->waitForElement("body .modal", 2);
        $I->see($title, TodayPage::$goalBackLogDone);
        $I->dontSee($title, TodayPage::$goalBackLogPlanning);
        $I->clickOk(TodayPage::$goalBackLogModal);
    }


    public function checkGoalIsInPlans($title, $categoryId)
    {
        $I = $this;

        $I->clickBackLogButton($categoryId);
        $I->waitForElement('body .modal', 2);

        $I->wait(1);
        $I->see($title, TodayPage::$goalBackLogPlanning);
        $I->dontSee($title, TodayPage::$goalBackLogDone);
        $I->clickOk(TodayPage::$goalBackLogModal);
    }
}