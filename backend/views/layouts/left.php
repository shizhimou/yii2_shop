<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
<!--                . Html::img('/'.Yii::$app->user->identity->img,['height'=>25])-->
                <?php if (Yii::$app->user->isGuest) {
                    echo '<img src="/image/moren.jpg" class="img-circle" alt="User Image"/>';
                }else{
/*                  echo '<img src="/<?=Yii::$app->user->identity->img?>" class="img-circle"*/
                //                                 alt="User Image"/>';
                  echo  \yii\helpers\Html::img('/'.Yii::$app->user->identity->img,['class'=>'img-circle','alt'=>'User Image']);
//                  echo "/".Yii::$app->user->identity->img;
                }?>


            </div>
            <div class="pull-left info">
                <p><?php if (Yii::$app->user->isGuest){
                        echo '<span class="hidden-xs">guest</span>';
                    }else{
                        echo Yii::$app->user->identity->username;
                    }?></p>
<!--                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
                <?php if (Yii::$app->user->isGuest){
                    echo yii\bootstrap\Html::a('<i class="fa fa-circle text-maroon"></i> Outline',['#']);

                }else{

                  echo  yii\bootstrap\Html::a('<i class="fa fa-circle text-success"></i>  Online',['#']);

                }?>

            </div>
        </div>

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
        <!-- /.search form -->

<!--        -->

        <?php
        use mdm\admin\components\MenuHelper;
        $callback = function($menu){
            $data = json_decode($menu['data'], true);
            $items = $menu['children'];
            $return = [
                'label' => $menu['name'],
                'url' => [$menu['route']],
            ];
            //处理我们的配置
            if ($data) {
                //visible
                isset($data['visible']) && $return['visible'] = $data['visible'];
                //icon
                isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
                //other attribute e.g. class...
                $return['options'] = $data;
            }
            //没配置图标的显示默认图标
            (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'fa fa-circle-o';
            $items && $return['items'] = $items;
            return $return;
        };
        //这里我们对一开始写的菜单menu进行了优化
        echo dmstr\widgets\Menu::widget( [
            'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback),
        ] ); ?>

    </section>

</aside>
