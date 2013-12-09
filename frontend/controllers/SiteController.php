<?php

namespace frontend\controllers;

use common\components\ClientApi;
use common\models\Goal;
use Yii;
use yii\web\Controller;
use common\models\LoginForm;
use frontend\models\ContactForm;
use common\models\User;
use yii\web\HttpException;
use yii\helpers\Security;
use Dropbox\AppInfo;
use Dropbox\WebAuthNoRedirect;


class SiteController extends Controller
{
    public $clientStorage;

    public function actionIndex()
    {
        $request = Yii::$app->request;
        if ($request->get('id')) {
            $user = new User();
            $user->id = $request->get('id');
            Yii::$app->user->login($user);
        }

        if (Yii::$app->user->isGuest) {
            echo '<a href="/?id=1">dev</a>';
            echo "\n\n\n\n";
            echo '<a href="/?id=2">prod</a>';
        } else {
            return $this->render('index');
        }
    }

    public function actionError() {
        echo 4;die;
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load($_POST) && $model->login()) {
            return $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new User();
        $model->setScenario('signup');
        if ($model->load($_POST) && $model->save()) {
            if (Yii::$app->getUser()->login($model)) {
                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new User();
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
            'status' => User::STATUS_ACTIVE,
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
