
<?php

use backend\models\GoodsCategory;
?>
<h1>商品分类</h1>

<td><a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus" title="添加分类">添加</span></a></td>


<?php
//$jss=<<<SDD
//
//$(function () {
//       $("input[name=hobby]").click(function () {
//       if(this.checked){
//           $("input[name=hobby]").prop("checked",true);
//           }else{
//           $("input[name=hobby]").prop("checked",false);
//           }
//       });
//
//SDD;
//
//$this->registerJs($jss);
//
//?>





    <?php

    use leandrogehlen\treegrid\TreeGrid;

    echo TreeGrid::widget([
        'dataProvider' => $dataProvider,
        'keyColumnName' => 'id',
        'parentColumnName' => 'parent_id',
        'columns' => [
            'name',
            'intro',
            ['class' => 'yii\grid\ActionColumn']
        ]
    ]);

    echo "注意：删除商品分类的时候，请先删除对应的商品，否则商品不能显示！！！";
    ?>

<style>

    .center{

        text-align: center;
    }
</style>
<div class="center">
    <?php
    use yii\widgets\LinkPager;

    echo LinkPager::widget(
        ['pagination' => $pagination]
    );

    ?>
</div>
<?php
$JS=<<<JS
  $(function() {
    $('#w1-info').fadeOut(5000);
  });
JS;
$this->registerJs($JS);
?>
