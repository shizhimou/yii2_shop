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
                        echo  Yii::$app->user->identity->name;
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

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Mou Shumei', 'options' => ['class' => 'header']],
//                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
//                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => '登录', 'icon' => 'user','url' => ['admin/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => '商品列表',
                        'icon' => 'share',
                        'url' => '/goods/index',
                        'items' => [
                            ['label' => '显示商品列表', 'icon' => 'th-list', 'url' => ['/goods/index'],],
                            ['label' => '添加商品', 'icon' => 'plus', 'url' => ['/goods/add'],],

                        ],
                    ],
                    [
                        'label' => '商品分类列表',
                        'icon' => 'share',
                        'url' => '/goods_category/index',
                        'items' => [
                            ['label' => '显示商品分类列表', 'icon' => 'th-list', 'url' => ['/goods-category/index'],],
                            ['label' => '添加商品分类', 'icon' => 'plus', 'url' => ['/goods-category/add'],],

                        ],
                    ],
                    [
                        'label' => '文章列表',
                        'icon' => 'share',
                        'url' => '/article/index',
                        'items' => [
                            ['label' => '显示文章', 'icon' => 'th-list', 'url' => ['/article/index'],],
                            ['label' => '添加文章', 'icon' => 'plus', 'url' => ['/article/add'],],
                            ['label' => '添加文章分类', 'icon' => 'plus', 'url' => ['/article/type'],],

                        ],
                    ],
                    [
                        'label' => '品牌列表',
                        'icon' => 'share',
                        'url' => '/brand/index',
                        'items' => [
                            ['label' => '显示品牌', 'icon' => 'th-list', 'url' => ['/brand/index'],'visible' => Yii::$app->user->can('brand/index')],
                            ['label' => '添加品牌', 'icon' => 'plus', 'url' => ['/brand/add'],
                                'visible' => Yii::$app->user->can('brand/add')],
                        ],
                        'visible' => Yii::$app->user->can('brand')
                    ],
                    [
                        'label' => '管理员列表',
                        'icon' => 'share',
                        'url' => '/admin/index',
                        'items' => [
                            ['label' => '显示管理员', 'icon' => 'th-list', 'url' => ['/admin/index'],],
                            ['label' => '添加管理员', 'icon' => 'plus', 'url' => ['/admin/add'],],

                        ],
                    ],
                    [
                        'label' => '权限列表',
                        'icon' => 'share',
                        'url' => '/auth-item/index',
                        'items' => [
                            ['label' => '显示权限', 'icon' => 'th-list', 'url' => ['/auth-item/index'],],
                            ['label' => '添加权限', 'icon' => 'plus', 'url' => ['/auth-item/add'],],
                            ['label' => '显示角色', 'icon' => 'th-list', 'url' => ['/role/index'],],
                            ['label' => '添加角色', 'icon' => 'plus', 'url' => ['/role/add'],],

                        ],

                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
