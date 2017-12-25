<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($admin, 'name');
echo $form->field($admin, 'num');
echo $form->field($admin, 'password')->passwordInput();

echo $form->field($admin, 'age');

//echo $form->field($admin, 'sex');
echo $form->field($admin, 'sex')->inline()->radioList(['男' => '男', '女' => '女'],['value'=>'男']);
//echo $form->field($admin, 'intro')->textarea();
echo \yii\helpers\Html::img('/' . $admin->img, ['height' => 30]);
echo $form->field($admin, 'imgFile')->fileInput();
//echo $form->field($admin, 'bid')->dropDownList($catess);

echo $form->field($admin, 'code')->widget(\yii\captcha\Captcha::className(), [
    'captchaAction' => 'admin/captcha',
    'template' => '<div class="row">
                          <div class="col-md-3">{input}</div>
                          <div class="col-md-3">{image}</div>
                   </div>',
]);

//echo $form->field($admins,'create_time')->textInput();
echo \yii\bootstrap\Html::submitButton('添加', ['class' => 'btn btn-success']);
\yii\bootstrap\ActiveForm::end();
?>