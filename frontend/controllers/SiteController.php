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

	public function actionSignup()
	{
		$model = new SignupForm();
		if ($model->load(Yii::$app->request->post())) {
			$user = $model->signup();
			if ($user) {
				if (Yii::$app->getUser()->login($user)) {
					return $this->goHome();
				}
			}
		}

		return $this->render('signup', [
			'model' => $model,
		]);
	}

	public function actionRequestPasswordReset()
	{
		$model = new PasswordResetRequestForm();
		if ($model->load(Yii::$app->request->post())) {
			if ($model->sendEmail()) {
				Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
				return $this->goHome();
			} else {
				Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
			}
		}

		return $this->render('requestPasswordResetToken', [
			'model' => $model,
		]);
	}

	public function actionResetPassword($token)
	{
		try {
			$model = new ResetPasswordForm($token);
		} catch (InvalidParamException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->load($_POST) && $model->resetPassword()) {
			Yii::$app->getSession()->setFlash('success', 'New password was saved.');
			return $this->goHome();
		}

		return $this->render('resetPassword', [
			'model' => $model,
		]);
	}
}
