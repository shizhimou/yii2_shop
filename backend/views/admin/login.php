<?php
//$form = \yii\bootstrap\ActiveForm::begin();
//echo $form->field($admin, 'num');
//echo $form->field($admin, 'password')->passwordInput();
//echo $form->field($admin, 'rememberMe')->checkbox();
////echo \yii\helpers\Html::img('/' . $admin->img, ['height' => 30]);
//echo \yii\bootstrap\Html::submitButton('登录', ['class' => 'btn btn-success']);
//\yii\bootstrap\ActiveForm::end();
//?>


<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>My Shop</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'num', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('num')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>


        <?= $form->field($model,'code',[ 'template'  =>

            '<div  class="row"><div class="col-md-12">{input}'.\yii\captcha\Captcha::widget([
                'model' =>$model,
                'attribute' =>'code',//模型中也要申明
                'captchaAction' =>'admin/captcha',//指定操作
                'template'  =>'{image}',//image代表此处生成验证码图片
                'imageOptions'   =>[
                    //以下atrribute属性，可自己扩展
                    'title'  =>'点击刷新',
                    'onclick'  =>'this.src=this.src+'."'?'".'+Math.random()',//js点击刷新
//                    'style' =>'margin-left:150px;'
                ],
                ]).'{error}</div></div>'])->textInput(['class'  =>'input-text size-L','placeholder'    =>'验证码','style'=>'width:100px'])
            ->label(false);//此处不使用模型中提供的label属性 ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

<!--        <div class="social-auth-links text-center">-->
<!--            <p>- OR -</p>-->
<!--            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in-->
<!--                using Facebook</a>-->
<!--            <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign-->
<!--                in using Google+</a>-->
<!--        </div>-->
        <!-- /.social-auth-links -->

        <a href="#">忘记密码</a>   &ensp;
        <a href="add" class="text-center">注册</a>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

