<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $name
 * @property string $age
 * @property string $sex
 * @property string $img
 */
class Admin extends \yii\db\ActiveRecord implements IdentityInterface
{
//    public function behaviors()
//    {
//       [
//           'class'=>TimestampBehavior::className(),
//            'attributes' => [
//                self::EVENT_BEFORE_INSERT=>['last_login_time','last_login_ip'],
//            ]
//       ];
//    }

//    public $username;
    public $imgFile;
//    public $code;
    /**
     * @inheritdoc
     */
    public $role=[];
    public static function tableName()
    {
        return 'admin';
    }

    public function scenarios()
{
    $scenarios = parent::scenarios();
    return array_merge($scenarios,[
        'create'=>['username','password','imgFile','num','age','role','sex'],
        'update'=>['username','age','imgFile','sex','role','num'],
    ]);
}
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['num'],'unique','on' => 'create'],
            [['username', 'age', 'sex','password','num','role'], 'required','on' => 'create'],
            [['num'],'unique'],
            [['username', 'age', 'sex','password','role'], 'required','on' => 'update'],
            [['imgFile'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png,jpg,gif'],
//            [['token','email','token_create_time','add_time','num','name','age','sex','password','imgFile','role'],'safe'],
//            [['num','name','age','sex','password','imgFile','role'],'safe'],
//            [['last_login_time','last_login_ip'],'safe'],
//            [['code'],'captcha','captchaAction' => 'admin/captcha']

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'age' => '年龄',
            'sex' => '性别',
            'imgFile' => '头像',
            'password'=>'密码',
//            'code'=>'验证码',
            'num'=>'账号',
            'role'=>'角色',
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
        return $this->token;
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
