<?php

class TodayPage
{
    // include url of current page
    static $URL = '/';


    public static $conclusionEditor = ".conclusion .eg-editor .ta-html";
    public static $reasonEditor = ".sidebar .goal_reason .eg-editor .ta-html";
    public static $decompositionEditor = ".sidebar .goal_decomposition .eg-editor .ta-html";
    public static $commentsEditor = ".sidebar .goal_comments .eg-editor .ta-html";

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    public static function reportDescription($n = 1)
    {
//        $n++;
//        $row = (int)(($n + 2) / 2);
//        $col = $n % 2 + 1;
//      return "#goals-grid .row:nth-child($row) .goal-detail:nth-child($col) textarea";

        $n++;
        return "#goals-grid .goal-detail:nth-child($n) .eg-editor .ta-html";
    }

    public static function goalEditingPanel($n = 1)
    {
//        $row = (int)(($n + 2) / 2);
//        $col = $n % 2 + 1;
//        return "#goals-grid .row:nth-child($row) .goal-detail:nth-child($col) .goal-control-panel";

        $n++;
        return "#goals-grid .goal-detail:nth-child($n) .editor-controls";
    }


    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: EditPage::route('/123-post');
     */
     public static function route($param)
     {
        return static::$URL.$param;
     }


}