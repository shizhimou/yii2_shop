<?php
/* @var $this yii\web\View */
?>
<h1>文章列表</h1>

<td><a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-success btn-sm">添加文章</a>
<td><a href="<?=\yii\helpers\Url::to(['type'])?>" class="btn btn-success btn-sm">添加类型</a>
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
                <td><?=Yii::$app->params['article_status'][$article->status]?></td>
                <td><?=date('Y-m-d H:i:s',$article->create_time)?></td>

                <td><?=\yii\helpers\Html::img('/'.$article->img,['height'=>30])?></td>
                <td><?=$article->view_count?></td>
                <td><?=$article->type->type?></td>

                <td><a href="content-edit?id=<?=$article->id?>">查看文章</a></td>

                <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$article->id])?>" class="btn btn-warning btn-sm">编辑</a>
                    <a href="<?=\yii\helpers\Url::to(['del','id'=>$article->id])?>" class="btn btn-danger btn-sm">删除</a>

                </td>
            </tr>
        <?php endforeach;?>


    </table>

