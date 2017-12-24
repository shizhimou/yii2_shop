<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */
/* @var $form ActiveForm */
?>
<div class="article-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'author') ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'sort') ?>
        <?= $form->field($model, 'type_id')->dropDownList($types) ?>
        <?= $form->field($model, 'status')->radioList([1=>'上架',2=>'下架'],['value'=>1]) ?>
        <?= $form->field($content, 'content')->textarea() ?>

    <?= $form->field($model, 'img')->widget('manks\FileInput', [
    ]);?>


    <div class="form-group">
            <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- article-add -->
