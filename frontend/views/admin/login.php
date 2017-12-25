<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($admin, 'num');
echo $form->field($admin, 'password')->passwordInput();
echo $form->field($admin, 'rememberMe')->checkbox();
//echo \yii\helpers\Html::img('/' . $admin->img, ['height' => 30]);
echo \yii\bootstrap\Html::submitButton('登录', ['class' => 'btn btn-success']);
\yii\bootstrap\ActiveForm::end();
?>