<?php
/* @var $this yii\web\View */
?>
<h1>品牌列表</h1>

<!--<td><a href="--><?//=\yii\helpers\Url::to(['add'])?><!--" class="btn btn-success btn-sm">添加</a>-->
<div class="table-responsive">
    <table class="table table-bordered table-responsive table-hover">
        <tr>
            <td>品牌序号</td>
            <td>品牌名称</td>
            <td>品牌标志</td>
            <td>品牌介绍</td>
            <td>品牌状态</td>
            <td>品牌排序</td>
            <td>操作</td>
        </tr>

        <?php foreach ($brands as $brand):?>
            <tr>
                <td><?=$brand->id?></td>
                <td><?=$brand->name?></td>
                <td><?=\yii\helpers\Html::img('/'.$brand->logo,['height'=>30])?></td>
                <td><?=$brand->intro?></td>
                <td><?=Yii::$app->params['status'][$brand->status]?></td>
                <td><?=$brand->sort?></td>
                <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$brand->id])?>" "><span class="glyphicon glyphicon-edit" title="编辑"></span></a>
                    <a href="<?=\yii\helpers\Url::to(['del','id'=>$brand->id])?>" ><span class="glyphicon glyphicon-trash" title="删除" onclick="return confirm('您确定删除吗?')"></span></a>
                    <a href="<?=\yii\helpers\Url::to(['delrcl','id'=>$brand->id])?>" ><span class="glyphicon glyphicon-share-alt" title="显示"></span></a>

</td>
            </tr>
        <?php endforeach;?>
    </table>
</div>
注意：删除品牌时，请删除相应的商品，否则商品不能显示！！！
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

