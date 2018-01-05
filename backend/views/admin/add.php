
<td><a href="<?=\yii\helpers\Url::to(['goods/index'])?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-share-alt">返回</span></a>

<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($admin, 'username');
echo $form->field($admin, 'num');
echo $form->field($admin, 'password')->passwordInput();

echo $form->field($admin, 'age');

//echo $form->field($admin, 'sex');
echo $form->field($admin, 'sex')->inline()->radioList(['男' => '男', '女' => '女'],['value'=>'男']);
//echo $form->field($admin, 'intro')->textarea();
echo \yii\helpers\Html::img('/' . $admin->img, ['height' => 30]);
echo $form->field($admin, 'imgFile')->fileInput();
echo $form->field($admin, 'role')->checkboxList($roles);
//echo $form->field($admin, 'bid')->dropDownList($catess);

//echo $form->field($admins,'create_time')->textInput();
echo \yii\bootstrap\Html::submitButton('添加', ['class' => 'btn btn-primary']);
\yii\bootstrap\ActiveForm::end();
?>

    <p>注意：角色请参照角色表！！！</p>
