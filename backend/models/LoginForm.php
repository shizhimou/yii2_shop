<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/21
 * Time: 21:08
 */

namespace backend\models;


use yii\base\Model;

class LoginForm extends Model
{

    public $num;
    public $password;
    public $rememberMe;
//    public $last_login_time;
//    public $last_login_ip;
    public $code;



    public function rules()
    {
        return [
            [['num','password'],'required'],
            [['code'],'captcha','captchaAction' => 'admin/captcha'],
//            [['last_login_time','last_login_ip','rememberMe'],'safe']
            [['rememberMe'],'safe']
        ];
    }

    public function attributeLabels()
    {
        return [

            'num'=>'账号',
            'password'=>'密码',
            'rememberMe'=>'记住我',
            'code'=>'验证码'
        ];
    }


}