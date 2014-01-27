<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;
use yii\web\HttpException;


class SiteController extends Controller
{
    public $clientStorage;

    public function actionIndex()
    {
        $request = Yii::$app->request;
        $user    = Yii::$app->user;

        if ($user->isGuest) {
            if ($request->get('id')) {
                $identity     = new User();
                $identity->id = $request->get('id');
                $user->login($identity);
            } else {
                echo '<a href="/?id=1">dev</a>';
                echo "\n\n\n\n";
                echo '<a href="/?id=2">prod</a>';
                return true;
            }
        }

        $this->clientStorage['init'] = $user->identity->getInitPageData();
        return $this->render('index');
    }

    public function actionError()
    {
    }

    public function actionRequestPasswordReset()
    {
        $model           = new User();
        $model->scenario = 'requestPasswordResetToken';
        if ($model->load($_POST) && $model->validate()) {
            if ($this->sendPasswordResetEmail($model->email)) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'There was an error sending email.');
            }
        }
        return $this->render('requestPasswordResetToken', array(
            'model' => $model,
        ));
    }

    public function actionResetPassword($token)
    {
        $model = User::find(array(
            'password_reset_token' => $token,
            'status'               => User::STATUS_ACTIVE,
        ));

        if (!$model) {
            throw new HttpException(400, 'Wrong password reset token.');
        }

        $model->scenario = 'resetPassword';
        if ($model->load($_POST) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }

        return $this->render('resetPassword', array(
            'model' => $model,
        ));
    }

}
