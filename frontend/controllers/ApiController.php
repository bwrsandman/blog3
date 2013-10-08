<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class ApiController extends Controller
{
    public function placess()
    {
        echo
        '[
            {
                "id":"27",
                "p_title":"Kiev",
                "p_description":"",
                "p_lng":"50.4",
                "p_lat":"30.76",
                "p_user_id":"2"
            },
            {
                "id":"38",
                "p_title":"Montreal",
                "p_description":"Montreal",
                "p_lng":"-73.59",
                "p_lat":"45.54",
                "p_user_id":"2"
            },
        ]';
    }
}
