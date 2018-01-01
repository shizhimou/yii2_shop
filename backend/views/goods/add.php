<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */
/* @var $form ActiveForm */
?>
<td><a href="<?=\yii\helpers\Url::to(['goods/index'])?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-share-alt">返回</span></a>
<div class="goods-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'sn') ?>

        <?= $form->field($model, 'goods_category_id')->dropDownList($types) ?>
        <?= $form->field($model, 'brand_id')->dropDownList($brands) ?>
        <?= $form->field($model, 'market_price') ?>
        <?= $form->field($model, 'shop_price') ?>
        <?= $form->field($model, 'status')->radioList([1=>'上架',2=>'下架'],['value'=>1]) ?>
        <?= $form->field($model, 'sort') ?>
        <?= $form->field($model, 'stock') ?>
    <?= $form->field($model, 'logo')->widget('manks\FileInput', [
        ])?>
    <?= $form->field($model, 'imgFiles')->widget('manks\FileInput', [
        'clientOptions' => [
            'pick' => [
                'multiple' => true,
            ],
            // 'server' => Url::to('upload/u2'),
            // 'accept' => [
            // 	'extensions' => 'png',
            // ],
        ],
    ]);?>
    <?= $form->field($content,'content')->widget('kucha\ueditor\UEditor',[
    ]);?>
    
        <div class="form-group">
            <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- goods-add -->
