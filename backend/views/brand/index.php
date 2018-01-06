<?php
/* @var $this yii\web\View */
?>
<h1>品牌列表</h1>

<td><a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus" title="添加品牌">添加</span></a>
<td><a href="<?=\yii\helpers\Url::to(['rcl'])?>" class="btn btn-primary btn-sm" title="回收站">回收站</a>
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
                <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$brand->id])?>" ><span class="glyphicon glyphicon-edit" title="编辑"></span></a>
                    <a href="<?=\yii\helpers\Url::to(['dal','id'=>$brand->id])?>" ><span class="glyphicon glyphicon-alert" title="你确定放入回收站？" onclick="return confirm('您确定放入回收站吗?')"></span></a>

            </tr>
        <?php endforeach;?>


    </table>
    </div>
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
    $('#w0-info').fadeOut(5000);
  });
JS;
    $this->registerJs($JS);
    ?>
