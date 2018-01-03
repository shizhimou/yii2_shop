<?php
/* @var $this yii\web\View */
?>
<h1>角色列表</h1>
<td><a href="<?=\yii\helpers\Url::to(['role/add'])?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus" title="添加商品">添加</span></a></td>

<table class="table table-bordered table-responsive table-hover">
    <tr>

        <td>角色名称</td>
        <td>角色权限</td>
        <td>角色描述</td>
        <td>操作</td>
    </tr>

    <?php foreach ($model as $models):?>
        <tr>
            <td>
                <?=$models->name?>
<!--                --><?php //if(strpos($models->name,'/')) {
//               echo  "---".$models->name;
//                }else{
//
//                    echo $models->name;
//                }?>
            </td>
            <td><?php
                $manage = Yii::$app->authManager;
                $pers = $manage->getPermissionsByRole($models->name);
//               var_dump($per);
                foreach ($pers as $per){

                    echo $per->description.'&ensp;';
                }

                ?></td>
            <td><?=$models->description?></td>


            <td><a href="<?=\yii\helpers\Url::to(['edit','name'=>$models->name])?>" ><span class="glyphicon glyphicon-edit" title="编辑"></a>
                <a href="<?=\yii\helpers\Url::to(['del','name'=>$models->name])?>" ><span class="glyphicon glyphicon-trash" title="删除" onclick="return confirm('您确定删除吗?')"></span></a></td>
        </tr>
    <?php endforeach;?>


</table>
<!--<style>-->
<!---->
<!--    .center{-->
<!---->
<!--        text-align: center;-->
<!--    }-->
<!--</style>-->
<!--<div class="center">-->
<!--    --><?php
//    use yii\widgets\LinkPager;
//
//    echo LinkPager::widget(
//        ['pagination' => $pagination]
//    );
//
//    ?>
<!--</div>-->

<?php
$JS=<<<JS

  $(function() {
    $('#w0-info').fadeOut(3000);
  });
JS;

$this->registerJs($JS);

?>


