<?php

namespace backend\controllers;



use backend\filter\LoginFilter;
use backend\models\Admin;
use backend\models\LoginForm;
use frontend\models\SignupForm;
use Symfony\Component\BrowserKit\Client;
use yii\data\Pagination;
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



//    public function behaviors()
//    {
//        return [
////                [
////                    'class'=>LoginFilter::className(),
////                ],
//                'access'=>[
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['index','add','login','edit', 'captcha'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'actions' => ['index','add','edit','logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ]
//                ],
//            ],
//
//
//
//
//        ];
//
//    }

    public function actionIndex()
    {
        $model = Admin::find()->orderBy('id');
        $count = $model->count();
        $pagination = new Pagination(
            ['totalCount' => $count, 'pageSize' => 3]
        );
        $model = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',compact('model','content','pagination'));


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

            $member = Admin::find()->all();
            if ($member->num === $admin->num){
                \Yii::$app->session->setFlash('info','该账号已经存在，请重新输入');
                return $this->redirect(['goods/index']);
            }
//            echo '<pre>';
//            var_dump($admin->password);exit;

            $admin->password = \Yii::$app->security->generatePasswordHash($admin->password);


            $admin->imgFile = UploadedFile::getInstance($admin, 'imgFile');
//            var_dump($admin->imgFile);exit;
            if ($admin->validate()) {
//                var_dump($admin->getErrors());exit;
            }
//            $path = \yii::getAlias('@webroot').'/image/'.uniqid().'.'.$admin->imgFile->extension;
            $admin->last_login_ip = \Yii::$app->request->userIP;
            $admin->last_login_time = time();
            $admin->add_time = time();
            $admin->token = \Yii::$app->security->generateRandomString();
            $path = 'image/'.uniqid().'.'.$admin->imgFile->extension;

            if ($admin->imgFile->saveAs($path,false)) {

                $admin->img = $path;
//                var_dump($admin->img);exit;


//                    var_dump($admin->create_time);exit;
                if ($admin->save(false)) {
                    //得到权限对象
                    $auth = \Yii::$app->authManager;
                    //通过权限对象得到角色
                    $role = $auth->getRole($admin->role);
                    //把用户分配到角色中
                    $auth->assign($role,$admin->id);
                    //自动登录，可以保存cookie值 login里面有两个参数
                    \Yii::$app->user->login($admin);
//                    var_dump($request->post());exit;
                    return $this->redirect(['goods/index']);
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
        $model = new LoginForm();

        //判定是不是表单提交
        if (\Yii::$app->request->isPost) {

            //绑定数据
            $model->load(\Yii::$app->request->post());

            //判定账号是否正确

            $num=Admin::find()->where(['num'=>$model->num])->one();
//            $num->img=$num['img'];
            $num->last_login_ip = \Yii::$app->request->userIP;
            $num->last_login_time = time();
            $num->token = \Yii::$app->security->generateRandomString();

//            echo '<pre>';
//            $num->save();
//            var_dump($num);exit;
//            var_dump($num->password);exit;
            if ($num) {

                $result=\Yii::$app->security->validatePassword($model->password,$num->password);
              if($result){

                  if ($model->validate()){
//                      var_dump($num->getErrors());exit;
                      if (\Yii::$app->user->login($num,$model->rememberMe?3600*24*7:0)) {

                          $num->save();
                          \Yii::$app->session->setFlash('info','登录成功',true);
                          return $this->redirect(['/goods/index']);
                      }
                  }


              }else{
                  $model->addError("password","密码错误");
              }

            }else{
                $model->addError("num","账号错误");
            }

        }


        return $this->render('login', ['model' => $model]);

    }

    public function actionLogout(){
        //注销用户
        if (\Yii::$app->user->logout()) {
            \Yii::$app->session->setFlash("info",'退出成功',true);
            return $this->redirect(['goods/index']);
        }

    }


}
