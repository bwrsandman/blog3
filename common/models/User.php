<?php
namespace common\models;

use yii\helpers\Security;
use yii\web\IdentityInterface;


class User extends generated\User implements IdentityInterface
{
	use \common\traits\Date;

	const STATUS_DELETED = 0;
	const STATUS_ACTIVE  = 10;

	const ROLE_USER = 10;

	public static function create($attributes)
	{
		/** @var User $user */
		$user = new static();
		$user->setAttributes($attributes);
		$user->setPassword($attributes['password']);
		$user->generateAuthKey();
		if ($user->save()) {
			return $user;
		} else {
			return null;
		}
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id)
	{
		return static::find($id);
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 *
	 * @return self
	 */
	public static function findByUsername($username)
	{
		return static::find(['username' => $username, 'status' => static::STATUS_ACTIVE]);
	}

	/**
	 * Finds user by password reset token
	 *
	 * @param string $token password reset token
	 *
	 * @return self
	 */
	public static function findByPasswordResetToken($token)
	{
		$expire    = \Yii::$app->params['user.passwordResetTokenExpire'];
		$parts     = explode('_', $token);
		$timestamp = (int)end($parts);
		if ($timestamp + $expire < time()) {
			// token expired
			return null;
		}

		return User::find([
			'password_reset_token' => $token,
			'status'               => User::STATUS_ACTIVE,
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function getId()
	{
		return $this->getPrimaryKey();
	}

	/**
	 * @inheritdoc
	 */
	public function getAuthKey()
	{
		return $this->auth_key;
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 *
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return Security::validatePassword($password, $this->password_hash);
	}

	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password
	 */
	public function setPassword($password)
	{
		$this->password_hash = Security::generatePasswordHash($password);
	}

	/**
	 * Generates "remember me" authentication key
	 */
	public function generateAuthKey()
	{
		$this->auth_key = Security::generateRandomKey();
	}

	/**
	 * Generates new password reset token
	 */
	public function generatePasswordResetToken()
	{
		$this->password_reset_token = Security::generateRandomKey() . '_' . time();
	}

	/**
	 * Removes password reset token
	 */
	public function removePasswordResetToken()
	{
		$this->password_reset_token = null;
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['status', 'default', 'value' => self::STATUS_ACTIVE],
			['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

			['role', 'default', 'value' => self::ROLE_USER],
			['role', 'in', 'range' => [self::ROLE_USER]],

			['username', 'filter', 'filter' => 'trim'],
			['username', 'required'],
			['username', 'string', 'min' => 2, 'max' => 255],

			['email', 'filter', 'filter' => 'trim'],
			['email', 'required'],
			['email', 'email'],
			['email', 'unique'],
		];
	}

	public function scenarios()
	{
		return [
			'signup'                    => [
				'username',
				'email',
				'password'
			],
			'resetPassword'             => ['password'],
			'requestPasswordResetToken' => ['email'],
		];
	}


	/**
	 * @return Conclusion
	 */
	public function getConclusion($day)
	{
		$conclusion = $this->hasOne(Conclusion::className(), ['fk_user' => 'id'])->day($day)->one();

		if (!$conclusion) {
			$conclusion = $this->createConclusionByDay($day);
		}

		return $conclusion;
	}

	public function createConclusionByDay($day)
	{
		$conclusion              = new Conclusion();
		$conclusion->scenario    = 'create';
		$conclusion->fk_user     = $this->id;
		$conclusion->report_date = $this->date($day);
		if (!$conclusion->save()) {
			$conclusion->throwValidationErrors();
		}
		return $conclusion;
	}

	public function getInitPageData()
	{
		/** @var $models Goal[] */
		$models = Goal::find()->owner($this->id)->all();
		$goals  = [];
		foreach ($models as $model) {
			$goals[] = $model->toArray();
		}
		$days = [
			'today',
			'yesterday'
		];

		/** @var $models Goal[] */
//        echo Yii::$app->user->getId();die;
		$user        = User::find(1);
		$conclusions = [];
		foreach ($days as $day) {
			$conclusions[$day] = $user->getConclusion($day)->toArray();
		}

		$response = [
			'categories'  => GoalCategory::find()->asArray()->all(),
			'goals'       => $goals,
			'conclusions' => $conclusions,
		];

		return $response;
	}

}
