<?php
/* @var $this yii\web\View */
?>
<h1>商品列表</h1>


<!--<td><a href="--><?//=\yii\helpers\Url::to(['type'])?><!--" class="btn btn-success btn-sm">添加类型</a>-->

    <div class="row">

        <div class="pull-left">
            <td><a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus" title="添加商品">添加</span></a>

        </div>

        <div class=" pull-right">
            <form class="form-inline">
                <select class="form-control" name="status">
                    <option value="">请选择</option>
                    <option value="1">激活</option>
                    <option value="2">禁用</option>
                </select>

                <div class="form-group">
                    <label for="exampleInputEmail2"></label>
                    <input type="text" class="form-control" name="minprice" size="3" placeholder="最低价" value="<?=Yii::$app->request->get("minprice");?>">

                </div>
                -
                <div class="form-group">

                    <input type="text" class="form-control" name="maxprice" size="3" placeholder="最高价" value="<?=Yii::$app->request->get("maxprice");?>">

                </div>


                <div class="form-group">
<!--                    <label for="exampleInputEmail2">Email</label>-->
                    <input type="text" class="form-control" name="keyword"  placeholder="请输入关键字" value="<?=Yii::$app->request->get("keyword");?>">



                </div>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" ></span></button>
            </form>

        </div>
    </div>

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

                <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$good->id])?>"><span class="glyphicon glyphicon-edit" title="编辑"></span></a>
                    <a href="<?=\yii\helpers\Url::to(['del','id'=>$good->id])?>" ><span class="glyphicon glyphicon-trash" title="删除" onclick="return confirm('您确定删除吗?')"></a>

                </td>
            </tr>
        <?php endforeach;?>
    </table>

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
    $('#w0-info').fadeOut(3000);
  });
JS;

$this->registerJs($JS);

?>




