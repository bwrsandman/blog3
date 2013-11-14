<?php
namespace common\models;

use yii\helpers\Security;
use yii\web\IdentityInterface;

class User extends generated\User implements IdentityInterface
{
    /**
     * @var string the raw password. Used to collect password input and isn't saved in database
     */
    public $password;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const ROLE_USER = 10;

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     *
     * @return IdentityInterface|null the identity object that matches the given ID.
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
     * @return null|User
     */
    public static function findByUsername($username)
    {
        return static::find([
            'username' => $username,
            'status'   => static::STATUS_ACTIVE
        ]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     *
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param string $password password to validate
     *
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Security::validatePassword($password, $this->password_hash);
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (($this->isNewRecord || $this->getScenario() === 'resetPassword') && !empty($this->password)) {
                $this->password_hash = Security::generatePasswordHash($this->password);
            }
            if ($this->isNewRecord) {
                $this->auth_key = Security::generateRandomKey();
            }

            return true;
        }

        return false;
    }
}
