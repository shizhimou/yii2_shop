<td><a href="<?=\yii\helpers\Url::to(['goods-category/index'])?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-share-alt">返回</span></a>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GoodsCategory */
/* @var $form ActiveForm */
?>
<div class="goods-category-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'parent_id') ?>



        <?= $form->field($model, 'intro') ?>
    
        <div class="form-group">

        </div>
    <?php ActiveForm::end(); ?>

</div><!-- goods-category-add -->

<?php
$js=<<<EOC
var treeObj = $.fn.zTree.getZTreeObj("w1");
treeObj.expandAll(true);
var node = treeObj.getNodeByParam("id", "$model->parent_id", null);

treeObj.selectNode(node);
console.debug(node);
EOC;

$this->registerJs($js);
?>
