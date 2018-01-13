<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>购物车页面</title>
	<link rel="stylesheet" href="/modules/style/base.css" type="text/css">
	<link rel="stylesheet" href="/modules/style/global.css" type="text/css">
	<link rel="stylesheet" href="/modules/style/header.css" type="text/css">
	<link rel="stylesheet" href="/modules/style/cart.css" type="text/css">
	<link rel="stylesheet" href="/modules/style/footer.css" type="text/css">

	<script type="text/javascript" src="/modules/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/modules/js/cart1.js"></script>
	
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
			<div class="flow fr">
				<ul>
					<li class="cur">1.我的购物车</li>
					<li>2.填写核对订单信息</li>
					<li>3.成功提交订单</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
	<div class="mycart w990 mt10 bc">
		<h2><span>我的购物车</span></h2>
		<table>
			<thead>
				<tr>
                    <th class="col0">选择商品</th>
					<th class="col1">商品名称</th>
					<th class="col3">单价</th>
					<th class="col4">数量</th>	
					<th class="col5">小计</th>
					<th class="col6">操作</th>
				</tr>
			</thead>
			<tbody id="tb">
            <form action="/order/lists" method="post" id="check">
            <?php foreach ($goods as $good):?>


				<tr id="<?=$good['id']?>">
                    <td class="col0">

                        <input type="hidden" name="id" value="<?=$good['id']?>"/>
                        <input type="checkbox" name="check[]" value="<?=$good['id']?>"/>

                    </td>
					<td class="col1"><a href=""><img src="<?=$good['logo']?>" alt="" /></a>  <strong><a href=""><?=$good['name']?></a></strong></td>
					<td class="col3">￥<span><?=$good['shop_price']?>.00</span></td>
					<td class="col4"> 
						<a href="javascript:;" class="reduce_num"></a>
						<input type="text" name="amount[]" value="<?=$good['num']?>" class="amount"/>
						<a href="javascript:;" class="add_num"></a>
					</td>
					<td class="col5">￥<span><?=$good['shop_price']*$good['num']?>.00</span></td>
					<td class="col6"><a href="/cart/del-cart?id=<?=$good['id']?>">删除</a></td>
				</tr>
            <?php endforeach;?>
            </form>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6">购物金额总计： <strong>￥ <span id="total">1870.00</span></strong></td>
				</tr>
			</tfoot>
		</table>
		<div class="cart_btn w990 bc mt10">
			<a href="" class="continue">继续购物</a>
			<a href="javascript:;" class="checkout">结 算</a>
		</div>
	</div>
    <div class="div">
<!--        <form action="/order/lists" method="post">-->
<!--            <input type="hidden" name="goodsDate" value="" id="goodsFrom"/>-->
<!--        </form>-->
    </div>

    <script>


        $(".checkout").click(function () {
//            var tempArr = [];
//            $('input[type="checkbox"]:checked').each(function (k,v) {
//                var tempId = $(v).prev().val();
//                var num = $(v).parent().next().next().next().children('input').val();
//                tempArr[tempId]=num;
//            $.post('/order/lists',{'amount':1,'check':[2,1]},function(){
//
//            });
         var keyVal = $("#check").serialize();
            if(keyVal.indexOf("check")>-1){
                $("#check").submit();
            }else {
                alert("请选择商品")
            }
        });

//            console.dir(tempArr)
//            $('#goodsFrom').attr('value',tempArr.parseJSON());
//            alert(22);
//

////            console.debug(11);
//

//           $.post("/order/lists",$("#check").serialize(),function (data) {
////               console.debug(data);
////               alert(data.replace(/\[|]/g,''));
//               var num = data.replace(/\[|]/g,'');
//               console.debug(num);
//               var obj = eval("(" + num + ")");
//               console.debug(obj.num);
//               var obj = JSON.parse(data);
//               $(obj).each(function (k,v) {
//                   console.debug(k);
//               })
//               for (var i in obj){
////                   console.debug(11);
//                   console.debug(i);
//               }


//               var obj = num.parseJSON();


//               for(var val in num){
//                   console.debug(val);
//               }
//               console.debug(parseJSON(num));
//               $.each(function (k,v) {
//                   console.debug(v);
//               },data);
//               window.location.href="/order/lists";
//           })
//        });


    </script>
	<!-- 主体部分 end -->

	<div style="clear:both;"></div>
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
