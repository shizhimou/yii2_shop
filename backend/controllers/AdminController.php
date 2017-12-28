<?php

namespace backend\controllers;



use backend\models\Admin;
use backend\models\LoginForm;
use frontend\models\SignupForm;
use yii\filters\AccessControl;
use yii\web\Request;
use yii\web\UploadedFile;

class AdminController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'captcha'=> [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'maxLength' => 4,
                'minLength' => 3,
            ]
        ];

    }

    public function behaviors()
    {
        return [
            'access'=>[
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','add','login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index','add','edit','logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
//        var_dump(\Yii::$app->homeUrl);exit;

        $model = Admin::find()->orderBy('id')->all();

        return $this->render('index',compact('model'));


    }

    public function actionAdd()
    {
        $admin = new Admin();
//var_dump(Author::find()->all());exit;
//        $cate = Author::find()->asArray()->all();
//        $catess = ArrayHelper::map($cate,'id','author_name');
//        var_dump($catess);
        $request = new Request();
        if ($request->isPost) {

            $admin->load($request->post());

//            echo '<pre>';
//            var_dump($admin->password);exit;

            $admin->password = \Yii::$app->security->generatePasswordHash($admin->password);


            $admin->imgFile = UploadedFile::getInstance($admin, 'imgFile');
//            var_dump($admin->imgFile);exit;
            if ($admin->validate()) {
//                var_dump($admin->getErrors());exit;
            }
//            $path = \yii::getAlias('@webroot').'/image/'.uniqid().'.'.$admin->imgFile->extension;
            $path = 'image/'.uniqid().'.'.$admin->imgFile->extension;

            if ($admin->imgFile->saveAs($path,false)) {

                $admin->img = $path;
//                var_dump($admin->img);exit;


//                    var_dump($admin->create_time);exit;
                if ($admin->save(false)) {
                    \Yii::$app->user->login($admin);
//                    var_dump($request->post());exit;
                    return $this->redirect(['index']);
                }else{
                    var_dump($admin->getErrors());exit;
                }

            }
        }
        return $this->render('add', ['admin' => $admin]);
    }

    public function actionEdit($id)
    {
        $admin = Admin::findOne($id);
//var_dump(Author::find()->all());exit;
//        $cate = Author::find()->asArray()->all();
//        $catess = ArrayHelper::map($cate,'id','author_name');
//        var_dump($catess);

        $request = new Request();
        if ($request->isPost) {

            $admin->load($request->post());

//            echo '<pre>';
//            var_dump($admin->password);exit;

            $password = \Yii::$app->security->generatePasswordHash($admin->password);

//              var_dump($password);exit;
            $admin->imgFile = UploadedFile::getInstance($admin, 'imgFile');
//            var_dump($admin->imgFile);exit;
            if ($admin->validate()) {
//                var_dump($admin->getErrors());exit;
            }
//            $path = \yii::getAlias('@webroot').'/image/'.uniqid().'.'.$admin->imgFile->extension;
            $path = 'image/'.uniqid().'.'.$admin->imgFile->extension;

            if ($admin->imgFile->saveAs($path,false)) {

                $admin->img = $path;
//                var_dump($admin->img);exit;


//                    var_dump($admin->create_time);exit;
                if ($admin->save(false)) {

//                    var_dump($request->post());exit;
                    return $this->redirect(['index']);
                }else{
                    var_dump($admin->getErrors());exit;
                }

            }
        }
        return $this->render('add', ['admin' => $admin]);
    }

    public function actionDel($id)
    {
        if (Admin::findOne($id)->delete()) {
            return $this->redirect(['index']);
        }
    }

    public function actionLogin()
    {
        $admin = new LoginForm();

        //判定是不是表单提交
        if (\Yii::$app->request->isPost) {

            //绑定数据
            $admin->load(\Yii::$app->request->post());

            //判定账号是否正确
            $num=Admin::find()->where(['num'=>$admin->num])->one();
//            var_dump($num->password);exit;
            if ($num) {
                $result=\Yii::$app->security->validatePassword($admin->password,$num->password);
              if($result){

                  if (\Yii::$app->user->login($num)) {
                      \Yii::$app->session->setFlash('success','登录成功',true);
                      return $this->redirect(['/article/index']);
                  }


              }else{
                  $admin->addError("password","密码错误");
              }

            }else{
                $admin->addError("num","账号错误");
            }

        }


        return $this->render('login', ['admin' => $admin]);

    }

    public function actionLogout(){
        //注销用户
        if (\Yii::$app->user->logout()) {
            \Yii::$app->session->setFlash("success",'退出成功',true);
            return $this->redirect(['index']);
        }

    }


}
