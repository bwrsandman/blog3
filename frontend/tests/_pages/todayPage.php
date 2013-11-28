<?php

class TodayPage
{
    // include url of current page
    static $URL = '/';


    public static $conclusionEditor = ".conclusion textarea";
    public static $reasonEditor = ".goal_reason_panel textarea";

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    public static function reportDescription($n = 1)
    {
        $row = (int)(($n + 2) / 2);
        $col = $n % 2 + 1;
        return "#goals-grid .row:nth-child($row) .goal-detail:nth-child($col) textarea";
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