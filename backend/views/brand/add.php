<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Brand */
/* @var $form ActiveForm */
?>
<div class="brand-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'status')->radioList([1=>'激活',2=>'禁用'],['value'=>1]) ?>
        <?= $form->field($model, 'intro')->textarea() ?>
        <?= $form->field($model, 'sort')->textInput(['value'=>100]) ?>
    <?= $form->field($model, 'logoFile')->fileInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- brand-add -->
