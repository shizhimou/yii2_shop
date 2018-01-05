<!--<td><a href="--><?//=\yii\helpers\Url::to(['add'])?><!--" class="btn btn-success btn-sm">注册</a>-->
<h1>管理员列表</h1>
    <table class="table table-bordered table-responsive table-hover">
        <tr>
            <td>用户序号</td>
            <td>用户姓名</td>
<!--            <td>所属角色</td>-->
            <td>用户年龄</td>
            <td>用户性别</td>
            <td>用户头像</td>
            <td>最后登录时间</td>
            <td>最后登录IP</td>
            <td>操作</td>
        </tr>

        <?php foreach ($model as $models):?>
            <tr>
                <td><?=$models->id?></td>
                <td><?=$models->username?></td>
                <td><?=$models->age?></td>
                <td><?=$models->sex?></td>
                <td><?=\yii\helpers\Html::img('/'.$models->img,['height'=>30])?></td>
                <td><?=date('Y-m-d H:i:s',$models->last_login_time)?></td>
                <td><?=long2ip($models->last_login_ip)?></td>

                <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$models->id])?>" ><span class="glyphicon glyphicon-edit" title="编辑"></a>
                    <a href="<?=\yii\helpers\Url::to(['del','id'=>$models->id])?>" ><span class="glyphicon glyphicon-trash" title="删除" onclick="return confirm('您确定删除吗?')"></span></a></td>
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



