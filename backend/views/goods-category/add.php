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
    <?= \liyuze\ztree\ZTree::widget([
        'setting' => '{
			data: {
				simpleData: {
					enable: true,
					pIdKey: "parent_id",
				}
			},
			callback: {
				onClick: function(e,treeId, treeNode){
				$("#goodscategory-parent_id").val(treeNode.id);
				},
			}
			
			
			
		}',
        'nodes' => $good,
    ]);
    ?>


        <?= $form->field($model, 'intro') ?>
    
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
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


提示：添加顶级类，父类ID请输入0；