<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/10
 * Time: 11:23
 */

namespace frontend\models;


use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $checkcode;
    public $checkbox;

    public function rules()
    {

        return [
          [['username','password','checkcode'],'required'],
          [['checkcode'],'captcha','captchaAction' => '/user/captcha'],
          [['checkbox'],'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username'=>'用户名',
            'password'=>'密码',
            'checkcode'=>'验证码',
            'checkbox'=>'记住我',

        ];

    }

}