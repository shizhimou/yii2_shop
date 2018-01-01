<td><a href="<?=\yii\helpers\Url::to(['article/index'])?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-share-alt">返回</span></a>

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
    <?= $form->field($model, 'img')->widget('manks\FileInput', [
    ]);?>
        <?= $form->field($content,'content')->widget('kucha\ueditor\UEditor',[
        ]);?>





    <div class="form-group">
            <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- article-add -->


