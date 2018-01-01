<td><a href="<?=\yii\helpers\Url::to(['auth-item/index'])?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-share-alt">返回</span></a>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */
/* @var $form ActiveForm */
?>

<div class="auth-item-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'description') ?>

    
        <div class="form-group">
            <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- auth-item-add -->
    <p>注意：名称就是路由格式！！！</p>
