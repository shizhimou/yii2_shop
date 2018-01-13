<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $login_ip
 * @property string $mobile
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
  public function behaviors()
  {
     return [
         [
        'class'=>TimestampBehavior::className(),
        'attributes' => [
            self::EVENT_BEFORE_INSERT=>['created_at','updated_at'],

            self::EVENT_AFTER_UPDATE=>['updated_at']
        ]
       ]
      ];

  }

    /**
     * @inheritdoc
     */
    public $repassword;
    public $checkcode;
    public $captcha;
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','password_hash','repassword','mobile','captcha'], 'required'],
            [['repassword'], 'compare','compareAttribute'=>'password_hash'],
            [['password_hash'],'string','min'=>6,'max' => 20],
            [['username'], 'unique'],
            [['captcha'],'check'],
            ['email', 'email'],
            [['checkcode'],'captcha','captchaAction' => 'user/captcha'],
            [['username'],'string','min'=>3, 'max' => 20],
            [['mobile'],'match','pattern'=>'/^[1][34578][0-9]{9}$/','message'=>'{attribute}必须为1开头的11位纯数字']
        ];
    }

    public function check($mobile,$params)
    {
        $session= \Yii::$app->session;
//        var_dump($this->$mobile);
//        var_dump($session->get('tel'.$this->mobile));exit;
        if (($this->$mobile)!=$session->get('tel'.$this->mobile)){
            $this->addError($mobile,'验证码不正确');
            return false;
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => '令牌',
            'password_hash' => '密码',
            'password_reset_token' => 'Password Reset Token',
            'email' => '邮箱',
            'status' => 'Status',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'login_ip' => '登录IP',
            'mobile' => '手机号',
            'repassword'=>'确认密码',
            'checkcode'=>'验证码',
            'captcha'=>'短信验证码'
        ];
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey()===$authKey;
    }
}
