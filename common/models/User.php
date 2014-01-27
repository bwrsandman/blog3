<?php
namespace common\models;

use yii\db\Query;
use yii\helpers\Security;
use yii\web\IdentityInterface;

class User extends generated\User implements IdentityInterface
{
    use \common\traits\Date;


    /**
     * @var string the raw password. Used to collect password input and isn't saved in database
     */
    public $password;
    protected $conclusionsCache;

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


    /**
     * @return Conclusion
     */
    public function getConclusion($day)
    {
        if (isset($this->conclusionsCache[$day])) {
            return $this->conclusionsCache[$day];
        }

        $conclusion = $this->hasOne(Conclusion::className(), ['fk_user' => 'id'])->day($day)->one();

        if (!$conclusion) {
            $conclusion = new Conclusion();
            $conclusion->scenario = 'create';
            $conclusion->fk_user = $this->id;
            $conclusion->report_date = $this->date($day);
            if (!$conclusion->save()) {
                $conclusion->throwValidationErrors();
            }
        }

        return $this->conclusionsCache[$day] = $conclusion;
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (($this->isNewRecord || $this->getScenario() === 'resetPassword') && !empty($this->password)) {
                $this->password_hash = Security::generatePasswordHash($this->password);
            }
            if ($insert) {
                $this->auth_key = Security::generateRandomKey();
            }

            return true;
        }

        return false;
    }


    public function getInitPageData()
    {
        /** @var $models Goal[] */
        $models = Goal::find()->owner($this->id)->all();
        $goals = [];
        foreach ($models as $model) {
            $goals[] = $model->toArray();
        }
        $days = [
            'today',
            'yesterday'
        ];

        /** @var $models Goal[] */
//        echo Yii::$app->user->getId();die;
        $user = User::find(1);
        $conclusions = [];
        foreach ($days as $day) {
            $conclusions[$day] = $user->getConclusion($day)->toArray();
        }

        $response = [
            'categories' => GoalCategory::find()->asArray()->all(),
            'goals' => $goals,
            'conclusions' => $conclusions,
        ];

        return $response;
    }

}
