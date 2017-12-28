<?php
/* @var $this yii\web\View */
?>
<h1>商品列表</h1>

<td><a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-success btn-sm">添加商品</a>
<!--<td><a href="--><?//=\yii\helpers\Url::to(['type'])?><!--" class="btn btn-success btn-sm">添加类型</a>-->
    <table class="table table-bordered table-responsive table-hover">
        <tr>
            <td>编号</td>
            <td>名称</td>
            <td>货号</td>
            <td>logo</td>
            <td>商品类型</td>
            <td>品牌</td>
            <td>市场价格</td>
            <td>本店价格</td>
            <td>库存</td>
            <td>状态</td>
            <td>排序</td>
<!--            <td></td>-->

            <td>上架时间</td>
            <td>商品详情</td>
            <td>操作</td>
        </tr>

        <?php foreach ($goods as $good):?>
            <tr>
                <td><?=$good->id?></td>
                <td><?=$good->name?></td>

                <td><?=$good->sn?></td>
                <td><?=\yii\helpers\Html::img($good->logo,['height'=>30])?></td>
                <td><?=$good->goods->name?></td>
                <td><?=$good->brand->name?></td>
                <td><?=$good->market_price?></td>
                <td><?=$good->shop_price?></td>
                <td><?=$good->stock?></td>

                <td><?php if (Yii::$app->params['status'][$good->status]=='激活'){
                        echo '<span class="glyphicon glyphicon-ok"></span>';}else{
                        echo '<span class="glyphicon glyphicon-remove"></span>';
                    }?></td>
                <td><?=$good->sort?></td>

                <td><?=$good->create_time?></td>

                <td><a href="content?id=<?=$good->id?>">商品详情</a></td>

                <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$good->id])?>" class="btn btn-warning btn-sm">编辑</a>
                    <a href="<?=\yii\helpers\Url::to(['del','id'=>$good->id])?>" class="btn btn-danger btn-sm">删除</a>

                </td>
            </tr>
        <?php endforeach;?>
    </table>

    <?php
    use yii\widgets\LinkPager;

    echo LinkPager::widget(
        ['pagination' => $pagination]
    );

    ?>




