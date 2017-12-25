<!--<td><a href="--><?//=\yii\helpers\Url::to(['add'])?><!--" class="btn btn-success btn-sm">注册</a>-->

    <table class="table table-bordered table-responsive table-hover">
        <tr>
            <td>用户序号</td>
            <td>用户姓名</td>
            <td>用户年龄</td>
            <td>用户性别</td>
            <td>用户头像</td>
            <td>操作</td>
        </tr>

        <?php foreach ($model as $models):?>
            <tr>
                <td><?=$models->id?></td>
                <td><?=$models->name?></td>
                <td><?=$models->age?></td>
                <td><?=$models->sex?></td>
                <td><?=\yii\helpers\Html::img('/'.$models->img,['height'=>30])?></td>
                <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$models->id])?>" class="btn btn-warning btn-sm">编辑</a>
                    <a href="<?=\yii\helpers\Url::to(['del','id'=>$models->id])?>" class="btn btn-danger btn-sm">删除</a></td>
            </tr>
        <?php endforeach;?>


    </table>





