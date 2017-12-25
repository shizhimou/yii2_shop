<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */
/* @var $form ActiveForm */
?>
<div class="article-add">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type') ?>
    <?= $form->field($model, 'intro') ?>
    <?= $form->field($model, 'status')->radioList([1=>'激活',2=>'禁用'],['value'=>1]) ?>
    <?= $form->field($model, 'sort')->textInput(['value'=>100]) ?>
    <?= $form->field($model, 'is_help')->radioList([1=>'不是',2=>'是'],['value'=>1]) ?>

    <div class="form-group">
        <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- article-add -->

