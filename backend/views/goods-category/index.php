
<?php

use backend\models\GoodsCategory;
?>
<h1>商品分类</h1>

<td><a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus">添加</span></a></td>
<td id="del"><a href="<?=\yii\helpers\Url::to(['delall'])?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash">一键删除</span></a></td>

    <table class="table table-bordered table-responsive table-hover">
        <tr>
            <td>选择</td>
            <td>序号</td>
            <td>名称</td>
            <td>父类ID</td>
            <td>tree</td>
            <td>lft</td>
            <td>操作</td>
        </tr>
        <?php
        $id=0;
        ?>
        <?php foreach ($models as $model):
//            if ($model->parent_id == 0) {
//                $name = $model->name;
//            }else{
//                $goods= GoodsCategory::findOne($model->parent_id);
//                $name = $goods->name;
//            }
            ?>
            <tr data-tree="<?=$model->tree?>" data-lft="<?=$model->lft?>" data-rgt="<?=$model->rgt?>">

                <form action="" method="post">
                <td><input type="checkbox" name="hobby" id="che" ></td>
                </form>
                <td><?=$model->id?></td>

                <td><span class="glyphicon glyphicon-minus-sign cate"></span><?=$model->name?></td>
                <td><?=$model->parent_id?></td>
                <td><?=$model->tree?></td>
                <td><?=$model->lft?></td>

                <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                    <a href="<?=\yii\helpers\Url::to(['del','id'=>$model->id])?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>

            </tr>
        <?php endforeach;?>


    </table>
    <?php
    $js=<<<EOF
  $(".cate").click(function(){
      
       $(this).toggleClass("glyphicon-minus-sign");
       $(this).toggleClass("glyphicon-plus-sign");
  
       var tr= $(this).parent().parent();
       
       var lft=tr.attr('data-lft');
       var rgt=tr.attr('data-rgt');
       
       var tree=tr.attr('data-tree');
       
       
       /*得到所有的tr*/
       
     var trs= $("tr")
       
       $.each(trs,function(k,v){
       
       var treePer=$(v).attr('data-tree');  
       var lftPer=$(v).attr('data-lft');
       var rgtPer=$(v).attr('data-rgt');
        console.log($(v).attr('data-lft'),$(v).attr('data-rgt'));
        
        if(tree==treePer && lftPer-lft>0 && rgtPer - rgt<0){
        
        $(v).toggle();
        }
       
       })
            
        
    });
EOF;
    $this->registerJs($js);

?>

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
    use yii\widgets\LinkPager;

    echo LinkPager::widget(
        ['pagination' => $pagination]
    );
    ?>
