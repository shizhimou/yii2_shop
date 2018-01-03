<?php

namespace backend\controllers;
use backend\models\Admin;
use backend\models\LoginForm;
use frontend\models\SignupForm;
use Symfony\Component\BrowserKit\Client;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Request;
use yii\web\UploadedFile;
class AdminController extends BaseController
{
    //验证的方法
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
    //管理员的显示方法
    public function actionIndex()
    {
        //分页
        $model = Admin::find()->orderBy('id');
        $count = $model->count();
        $pagination = new Pagination(
            ['totalCount' => $count, 'pageSize' => 3]
        );
        $model = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',compact('model','content','pagination'));
    }
    //管理员添加方法
    public function actionAdd()
    {
        $admin = new Admin();
        $admin->setScenario('create');
        $request = new Request();
        //得到权限对象
        $auth = \Yii::$app->authManager;
        if ($request->isPost) {
            $admin->load($request->post());
            //把输入的密码转化为哈希密码
            $admin->password = \Yii::$app->security->generatePasswordHash($admin->password);
            //接受图片文件
            $admin->imgFile = UploadedFile::getInstance($admin, 'imgFile');
            //验证数据
            $admin->validate();
            //记录登录IP地址
            $admin->last_login_ip =  ip2long(\Yii::$app->request->userIP);
            //记录登录时间
            $admin->last_login_time = time();
            //记录创建时间
            $admin->add_time = time();
            //创建令牌
            $admin->token = \Yii::$app->security->generateRandomString();
            //组装图片地址
            $path = 'image/'.uniqid().'.'.$admin->imgFile->extension;
            //图片保存到服务器端
            if ($admin->imgFile->saveAs($path,false)) {
                //图片地址存到数据库对象中
                $admin->img = $path;

                //由于验证码只需要验证一次，所以save为false
                if ($admin->save(false)) {
//                    var_dump($admin->role);exit;
                    foreach ($admin->role as $roleName){
//                      var_dump($roleName);exit;
                        //通过权限对象得到角色
                        $role = $auth->getRole($roleName);
                        //通过用户id把用户分配到角色中
                        $auth->assign($role,$admin->id);
                    }

                    //自动登录，可以保存cookie值 login里面有两个参数
                    \Yii::$app->user->login($admin);
                    return $this->redirect(['goods/index']);
                }else{
                    var_dump($admin->getErrors());exit;
                }
            }
        }
        $roles = $auth->getRoles();

//        $roles = array_keys($roles);
        $roles = ArrayHelper::map($roles,'name','description');
//        var_dump($roles);exit;

        return $this->render('add', ['admin' => $admin,'roles'=>$roles]);
    }
    //管理员修改方法
    public function actionEdit($id)
    {
        $admin = Admin::findOne($id);
        $admin->setScenario('update');
        $admin->password = "";
        $request = new Request();
        //得到权限对象
        $auth = \Yii::$app->authManager;
        $rolename = $auth->getRolesByUser($id);
//        var_dump($rolename);exit;
        $admin->role = array_keys($rolename);

        if ($request->isPost) {
            $member = Admin::findOne($id);
            $admin->load($request->post());
            $admin->password = $member->password;
            $password = \Yii::$app->security->generatePasswordHash($admin->password);
            $admin->imgFile = UploadedFile::getInstance($admin, 'imgFile');
            $admin->validate();
            $path = 'image/'.uniqid().'.'.$admin->imgFile->extension;
            if ($admin->imgFile->saveAs($path,false)) {
                $admin->img = $path;
                if ($admin->save(false)) {
                    //得到角色
                    $role = $auth->getRolesByUser($id);
//                    $role = array_keys($role);
//                    var_dump($role);exit;
                    foreach ($role as $roname){
//                        var_dump($roname);exit;
                        $role = $auth->revoke($roname,$id);
                    }
//                    var_dump($role);exit;
                    foreach ($admin->role as $roleName) {
//                      var_dump($roleName);exit;
                        //通过权限对象得到角色
                        $role = $auth->getRole($roleName);
                        //通过用户id把用户分配到角色中
                        $auth->assign($role, $admin->id);
                    }
                    return $this->redirect(['index']);
                }else{
                    var_dump($admin->getErrors());exit;
                }
            }
        }
        $roles = $auth->getRoles();

//        $roles = array_keys($roles);
        $roles = ArrayHelper::map($roles,'name','description');
        return $this->render('add', ['admin' => $admin,'roles'=>$roles]);
    }
    //管理员删除方法
    public function actionDel($id)
    {
        if (Admin::findOne($id)->delete()) {
            return $this->redirect(['index']);
        }
    }
    //管理员登录方法
    public function actionLogin()
    {
        //实例化表单模型
        $model = new LoginForm();
        //判断是否为游客 ，不是游客跳转到主页
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['goods/index']);
        }
        //判定是不是表单提交
        if (\Yii::$app->request->isPost) {
            //绑定数据
            $model->load(\Yii::$app->request->post());
            //判定账号是否正确
            $num=Admin::find()->where(['num'=>$model->num])->one();
            //判定数据库的账号是否存在
            if ($num) {
                $num->last_login_ip = ip2long(\Yii::$app->request->userIP);
//            var_dump(ip2long(\Yii::$app->request->userIP));exit;
                $num->last_login_time = time();
                $num->token = \Yii::$app->security->generateRandomString();
                //验证输入的密码和数据库中的密码是否一致
                $result=\Yii::$app->security->validatePassword($model->password,$num->password);
                //判定是否存在
              if($result){
                  //判定验证是否成功
                  if ($model->validate()){
                      //自动登录，判定是否记录保存登录信息
                      if (\Yii::$app->user->login($num,$model->rememberMe?3600*24*7:0)) {
                          //保存数据
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
    //管理员退出登录方法
    public function actionLogout(){
        //注销用户
        if (\Yii::$app->user->logout()) {
            \Yii::$app->session->setFlash("info",'退出成功',true);
            return $this->redirect(['admin/login']);
        }

    }
}
