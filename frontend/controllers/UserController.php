<?php

namespace frontend\controllers;

use frontend\components\ShopCart;
use frontend\models\LoginForm;
use frontend\models\User;
use Mrgoon\AliSms\AliSms;
use yii\helpers\Json;
use yii\web\Session;
class UserController extends \yii\web\Controller
{
   // public $enableCsrfValidation = false;

    public function actions() {
        return [
            'captcha' =>  [
                'class' => 'yii\captcha\CaptchaAction',
                'minLength' => 4,
                'maxLength' => 4
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRegist()
    {

        $user = new User();
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $user->load($request->post());
            if ($user->validate()) {

                $user->password_hash=\Yii::$app->security->generatePasswordHash($user->password_hash);
//                var_dump($request->post());exit;
                $user->auth_key=\Yii::$app->security->generateRandomString();
                if ($user->save(false)) {
                    \Yii::$app->user->login($user);
                    return Json::encode(
                       [
                           'status'=>1,
                           'msm'=>'注册成功',
                           'data'=>$user
                       ]
                    );
                }

            }else{
//                var_dump($user->errors);exit;
                return Json::encode(
                    [
                        'status'=>0,
                        'msm'=>'注册失败',
                        'data'=>$user->errors
                    ]
                    );
            }


        }

        return $this->render('regist');
    }

    public function actionSms($mobile)
    {

        if(!preg_match("/^1[34578]\d{9}$/", $mobile)){
//            var_dump(preg_match("/^1[34578]\d{9}$/", $mobile));
            return Json::encode("手机号码格式不正确");
        }

        $code = rand(100000,999999);

        $session= \Yii::$app->session;
        $session->set('tel'.$mobile,$code);
//        var_dump($session->set('tel'.$mobile,$code));
        var_dump($session->get('tel'.$mobile));
        $config = [
                'access_key' => 'LTAIl4sOfrzyQCYZ',
                'access_secret' => 'uEe9tu5pbnB7csClhN3T6mKpoLpA4x',
                'sign_name' => '史志谋',
            ];
            $alims = new AliSms();
            $response = $alims->sendSms($mobile, 'SMS_120366029', ['code'=> $code], $config);
            var_dump($response);

        return Json::encode($code);

    }

    public function actionLogin()
    {
//        var_dump($back);exit;
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['user/index']);
        }

        $user = new LoginForm();
        $request = \Yii::$app->request;
        if ($request->isPost) {

            $user->load($request->post());
//            var_dump($user->load($request->post()));exit;
            $mem = User::find()->where(['username'=>$user->username])->one();
//            var_dump($mem);exit;
            if ($user->validate()){
                if ($mem){
                    if (\Yii::$app->security->validatePassword($user->password,$mem->password_hash)) {

                        $mem->login_ip = ip2long(\Yii::$app->request->userIP);
                        if ($mem->save(false)) {
                            \Yii::$app->user->login($mem,$user->checkbox?3600*24*7:0);
                            //清空cookie，保存到数据库
                            $cart = new ShopCart();
                            $cart->todb();
                            $cart->flush()->save();

                            return
                                Json::encode(
                                    [
                                        'status'=>1,
                                        'msm'=>'登录成功',
                                        'data'=>$user,

                                    ]
                                );


//                             return $this->redirect(['user/index']);
                        }

                    }
                }
            }else{
                return Json::encode(
                    [
                        'status'=>0,
                        'msm'=>'登录失败',
                        'data'=>$user->errors
                    ]
                );

            }

        }


        return $this->render('login');
    }

    public function actionLogout()
    {
        if (\Yii::$app->user->logout()) {

            return $this->redirect(['user/index']);
        }
    }

//    public function actionCheck($tel)
//    {
//        $code = \Yii::$app->session->get($tel);
//
//        var_dump($code);
//     }


}
