<?php

class BaseDayPage
{
    // include url of current page
    static $URL = '/';

    const PROFESSIONAL_CAT = "Professional";
    const HEALTH_CAT = "Health";
    const OWN_CAT = "Own";
    const GLOBAL_CAT = "Global";

    const PROFESSIONAL_ID = 1;
    const HEALTH_ID = 2;
    const OWN_ID = 3;
    const GLOBAL_ID = 4;

    public static $conclusionEditor = ".conclusion .eg-editor .ta-text";
    public static $reportEditor = ".sidebar .goal_report .eg-editor .ta-text";
    public static $reasonEditor = ".sidebar .goal_reason .eg-editor .ta-text";
    public static $decompositionEditor = ".sidebar .goal_decomposition .eg-editor .ta-text";
    public static $commentsEditor = ".sidebar .goal_comments .eg-editor .ta-text";

    //modal add/edit
    public static $goalEditModal = ".goal-edit-modal";
    public static $goalAddModal = ".goal-add-modal";
    public static $goalTitleEditor = "#modalGoalTitle";
    public static $goalTitleCategorySelect = "#modalGoalCategory";

    //modal backlog
    public static $goalBackLogModal = ".goal-back-log-modal";
    public static $goalBackLogPlanning = ".goal-back-log-modal .goals-planing tbody";
    public static $goalBackLogDone = ".goal-back-log-modal .goals-done tbody";


    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */
    public static function goal($n)
    {
//        $n++;
//        $row = (int)(($n + 3) / 3);
//        $col = $n % 3 + 1;
//        return "#goals-grid .category-panel:nth-child($row) .goal-detail:nth-child($col)";

        return "#goals-grid .sel-goal-$n";
    }

    public static function category($n)
    {
        return "#goals-grid .sel-cat-$n";
    }

    public static function goalInCategory($goal, $category)
    {
        return "#goals-grid .sel-cat-{$category} .sel-goal-{$goal}";
    }

    public static function goalTitle($n)
    {
        return static::goal($n) . " .goal_title .panel-title";
    }

    public static function goalEditingPanel($n)
    {
        return static::goal($n) . " .eg-control-panel";
    }

    public static function goalEditButton($n)
    {
        return static::goal($n) . " .goal-edit-button";
    }

    public static function goalAddButton($n)
    {
        return static::category($n) . " .goal-add-button";
    }

    public static function goalBackLogButton($n)
    {
        return static::category($n) . " .category-backlog-button";
    }

    public static function goalCompleteButton($n)
    {
        return static::goal($n) . " .goal-complete-button";
    }

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: EditPage::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL . $param;
    }


}