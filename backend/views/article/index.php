<?php
/* @var $this yii\web\View */
?>
<h1>文章列表</h1>

<td><a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus" title="添加文章">文章</span></a>
<td><a href="<?=\yii\helpers\Url::to(['type'])?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus" title="添加文章类型">类型</span></a>
    <div class="table-responsive">
    <table class="table table-bordered table-responsive table-hover">
        <tr>
            <td>编号</td>
            <td>作者</td>
            <td>标题</td>
            <td>排名</td>
            <td>状态</td>
            <td>创建时间</td>
            <td>logo</td>
            <td>浏览次数</td>
            <td>文章类型</td>

            <td>阅读文章</td>

            <td>操作</td>
        </tr>

        <?php foreach ($articles as $article):?>
            <tr>
                <td><?=$article->id?></td>
                <td><?=$article->author?></td>

                <td><?=$article->title?></td>
                <td><?=$article->sort?></td>


                <td><?php if (Yii::$app->params['status'][$article->status]=='激活'){
                    echo '<span class="glyphicon glyphicon-ok"></span>';}else{
                        echo '<span class="glyphicon glyphicon-remove"></span>';
                    }?></td>
                <td><?=$article->time?></td>

                <td><?=\yii\helpers\Html::img($article->img,['height'=>30])?></td>
                <td><?=$article->view_count?></td>
                <td><?=$article->type->type?></td>

                <td><a href="content-edit?id=<?=$article->id?>">查看文章</a></td>

                <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$article->id])?>" ><span class="glyphicon glyphicon-edit" title="编辑"></span></a>
                    <a href="<?=\yii\helpers\Url::to(['del','id'=>$article->id])?>" ><span class="glyphicon glyphicon-trash" title="删除" onclick="return confirm('您确定删除吗?')"></a>

                </td>
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

