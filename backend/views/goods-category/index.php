
<?php

use backend\models\GoodsCategory;
?>
<h1>商品分类</h1>

<td><a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus">添加</span></a></td>


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
            'parent_id',
            ['class' => 'yii\grid\ActionColumn']
        ]
    ]);


    use yii\widgets\LinkPager;

    echo LinkPager::widget(
        ['pagination' => $pagination]
    );
    ?>
