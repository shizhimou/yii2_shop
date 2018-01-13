<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>填写核对订单信息</title>
    <link rel="stylesheet" href="/modules/style/base.css" type="text/css">
    <link rel="stylesheet" href="/modules/style/global.css" type="text/css">
    <link rel="stylesheet" href="/modules/style/header.css" type="text/css">
    <link rel="stylesheet" href="/modules/style/fillin.css" type="text/css">
    <link rel="stylesheet" href="/modules/style/footer.css" type="text/css">

    <script type="text/javascript" src="/modules/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/modules/js/cart2.js"></script>

</head>
<body>
<!-- 顶部导航 start -->
<?php

include_once Yii::getAlias("@app/views/common/nav.php");

?>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">
        <h2 class="fl"><a href="index.html"><img src="/modules/images/logo.png" alt="京西商城"></a></h2>
        <div class="flow fr flow2">
            <ul>
                <li>1.我的购物车</li>
                <li class="cur">2.填写核对订单信息</li>
                <li>3.成功提交订单</li>
            </ul>
        </div>
    </div>
</div>
<!-- 页面头部 end -->

<div style="clear:both;"></div>

<form action="" method="post" id="alldata">
    <!-- 主体部分 start -->
    <div class="fillin w990 bc mt15">
        <div class="fillin_hd">
            <h2>填写并核对订单信息</h2>
        </div>

        <form class="fillin_bd">
            <!-- 收货人信息  start-->
            <div class="address">
                <h3>收货人信息</h3>
                <div class="address_info">

                    <?php foreach ($info as $in):?>


                        <p>
                            <input type="radio" value="<?=$in->id?>" name="address_id" <?=$in->status==1?"checked":""?>/><?php echo $in->id;echo "."; echo $in->username; echo "&ensp;";echo $in->address ;echo "&ensp;";echo $in->tel?>
                        </p>
                    <?php endforeach;?>
                </div>

                <!--            <div class="address_select none">-->

                <!--                <form action="" class="none" name="address_form">-->
                <!--                    <ul>-->
                <!--                        <li>-->
                <!--                            <label for=""><span>*</span>收 货 人：</label>-->
                <!--                            <input type="text" name="" class="txt" />-->
                <!--                        </li>-->
                <!--                        <!--							<li>-->
                <!--                        <label for=""><span>*</span>所在地区：</label>-->
                <!--								<select name="" id="">-->
                <!--									<option value="">请选择</option>-->
                <!--									<option value="">北京</option>-->
                <!--									<option value="">上海</option>-->
                <!--									<option value="">天津</option>-->
                <!--									<option value="">重庆</option>-->
                <!--									<option value="">武汉</option>-->
                <!--								</select>-->
                <!---->
                <!--								<select name="" id="">-->
                <!--									<option value="">请选择</option>-->
                <!--									<option value="">朝阳区</option>-->
                <!--									<option value="">东城区</option>-->
                <!--									<option value="">西城区</option>-->
                <!--									<option value="">海淀区</option>-->
                <!--									<option value="">昌平区</option>-->
                <!--								</select>-->
                <!---->
                <!--								<select name="" id="">-->
                <!--									<option value="">请选择</option>-->
                <!--									<option value="">西二旗</option>-->
                <!--									<option value="">西三旗</option>-->
                <!--									<option value="">三环以内</option>-->
                <!--								</select>-->
                <!--							</li>-->
                <!--                        <script language="javascript" src="/modules/js/PCASClass.js"></script>-->
                <!--                        <select name="province3"></select><select name="city3"></select><select name="area3"></select><br>-->
                <!--                        <script language="javascript" defer>-->
                <!---->
                <!--                            new PCAS("province3","city3","area3");-->
                <!---->
                <!--                        </script>-->
                <!--                        <li>-->
                <!--                            <label for=""><span>*</span>详细地址：</label>-->
                <!--                            <input type="text" name="" class="txt address"  />-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <label for=""><span>*</span>手机号码：</label>-->
                <!--                            <input type="text" name="" class="txt" />-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </form>-->
                <!--					<a href="/list/address" class="confirm_btn"><span>保存收货人信息</span></a>-->
                <!--            </div>-->
            </div>
            <!-- 收货人信息  end-->

            <!-- 配送方式 start -->
            <div class="delivery">
                <!--            <h3>送货方式 </h3>-->
                <!--				<div class="delivery_info">-->
                <!--					<p>普通快递送货上门</p>-->
                <!--					<p>送货时间不限</p>-->
                <!--				</div>-->

                <div class="delivery_select">
                    <table>
                        <thead>
                        <tr>
                            <th class="col1">送货方式</th>
                            <th class="col2">运费</th>
                            <th class="col3">运费标准</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach (Yii::$app->params['SendType'] as $k=>$v):?>
                            <tr class="<?=$k==0?"cur":""?>">
                                <td>
                                    <input type="radio" name="delivery" <?=$k==0?"checked":""?> value="<?=$v['money']?>" id="vel"/><?=$v['type']?>

                                </td>
                                <td><?=$v['money']?></td>
                                <td><?=$v['intro']?></td>
                            </tr>
                        <?php endforeach;?>

                        </tbody>
                    </table>
                    <!--					<a href="" class="confirm_btn"><span>确认送货方式</span></a>-->
                </div>
            </div>
            <!-- 配送方式 end -->

            <!-- 支付方式  start-->
            <div class="pay">
                <h3>支付方式</h3>
                <div class="pay_info">

                </div>

                <div class="pay_select ">
                    <table>

                        <?php foreach (Yii::$app->params['PayType'] as $k=>$v):?>
                            <tr class="<?=$k==0?"cur":""?>">
                                <td class="col1"><input type="radio" name="pay" <?=$k==0?"checked":""?> value="<?=$v['type']?>"/><?=$v['type']?></td>
                                <!--                        --><?php //echo "&ensp;";echo "&ensp;";echo "&ensp;"?>
                                <td class="col2"><?=$v["intro"]?></td>
                            </tr>
                            <!--                        --><?php //echo "<br/>"?>
                        <?php endforeach;?>

                    </table>
                    <!--					<a href="" class="confirm_btn"><span>确认支付方式</span></a>-->
                </div>
            </div>
        </form>
        <!-- 支付方式  end-->
        <!-- 发票信息 end-->

        <!-- 商品清单 start -->
        <div class="goods">
            <h3>商品清单</h3>
            <table>
                <thead>
                <tr>

                    <th class="col1">商品</th>
                    <th class="col3">价格</th>
                    <th class="col4">数量</th>
                    <th class="col5">小计</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=0; $money=0;?>
                <?php foreach ($goods as $good=>$v):
                    ?>
                    <input type="hidden" name="che<?=$v['id']?>" value="<?=$v['id']?>">
                    <tr id="<?=$v['id']?>">
                        <td class="col1"><a href=""><img src="<?=$v['logo']?>" alt="" /></a>  <strong><a href=""><?=$v['name']?></a></strong></td>
                        <td class="col3">￥<?=$v['shop_price']?>.00</td>
                        <td class="col4"> <?=$v['num']?></td>
                        <td class="col5"><span>￥<?=$v['shop_price'] * $v['num']?>.00</span></td>
                    </tr>
                    <?= $money +=$v['shop_price'] * $v['num']?>
                    <?php echo $num +=$v['num']?>
                <?php endforeach;?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <ul>
                            <li>
                                <span><?php echo $num ?> 件商品，总商品金额：</span>
                                <em id="some">￥<?php echo $money ?>.00</em>
                            </li>

                            <li>
                                <span>运费：</span>
                                <em id="em">￥10.00</em>
                            </li>
                            <li>
                                <span>应付总额：</span>
                                <em id="total">￥<?php echo $money+10 ?>.00</em>
                            </li>
                        </ul>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- 商品清单 end -->

    </div>

    <div class="fillin_ft">
        <a href="javascript:;" class="checks"><span>提交订单</span></a>
        <p>应付总额：<strong id="all">￥<?php echo $money+10 ?>.00元</strong></p>

    </div>

    <!-- 主体部分 end -->

    <div style="clear:both;"></div>


    <script>
        var some="";
        $("input[type=radio]").click(function () {
            var vel = ($(this).parent().next().text());
//        alert(($(this).parent().next().text()));
            $("#em").text(vel);
            var em = $("#em").text();
            em = em.replace(/￥/, "");
            em =  parseInt(em);
//        alert(em);
            some = $("#some").text();
            some =  some.replace(/￥/, "");
            some =  parseInt(some);

//       alert(some);
            some = String(some+em);
            $("#total").text("￥"+some+".00");
            $("#all").text("￥"+some+".00");
        });
        $(".checks").click(function () {
            var em = $("#em").text();
            em = em.replace(/￥/, "");
            em =  parseInt(em);

            some = $("#some").text();
            some =  some.replace(/￥/, "");
            some =  parseInt(some);
            some = String(some+em);
//       alert(some);

//            alert($("input[type=hidden]").serialize());
//            var che = $("input[type=hidden]").serialize();
//        alert($("input[type=radio]:checked").serialize());
           var All =   ($("input[type=radio]:checked").serialize()) +"&money="+some ;
//           alert(All);
            $.post("/order/orders",All,function (data) {
                console.dir(data);
            });
//            $.get("/order/detail",che,function (data) {
//                console.dir(data);
//            })
        });


    </script>
    <!-- 底部版权 start -->
    <div class="footer w1210 bc mt15">
        <p class="links">
            <a href="">关于我们</a> |
            <a href="">联系我们</a> |
            <a href="">人才招聘</a> |
            <a href="">商家入驻</a> |
            <a href="">千寻网</a> |
            <a href="">奢侈品网</a> |
            <a href="">广告服务</a> |
            <a href="">移动终端</a> |
            <a href="">友情链接</a> |
            <a href="">销售联盟</a> |
            <a href="">京西论坛</a>
        </p>
        <p class="copyright">
            © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号
        </p>
        <p class="auth">
            <a href=""><img src="/modules/images/xin.png" alt="" /></a>
            <a href=""><img src="/modules/images/kexin.jpg" alt="" /></a>
            <a href=""><img src="/modules/images/police.jpg" alt="" /></a>
            <a href=""><img src="/modules/images/beian.gif" alt="" /></a>
        </p>
    </div>
    <!-- 底部版权 end -->
</body>
</html>
