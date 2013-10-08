<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class RpcController extends Controller
{
    public function actions()
    {
        return array(
            'index' => array(
                'class' => '\nizsheanez\JsonRpc\Action',
            ),
        );
    }

    public function search($data)
    {
        echo json_encode(array(
            array(
                'title' => 1,
                'decr' => 4
            ),
            array(
                'title' => 6,
                'decr' => 7
            )
        ));
    }
}
