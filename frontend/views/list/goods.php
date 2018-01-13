<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>商品页面</title>
	<link rel="stylesheet" href="/modules/style/base.css" type="text/css">
	<link rel="stylesheet" href="/modules/style/global.css" type="text/css">
	<link rel="stylesheet" href="/modules/style/header.css" type="text/css">
	<link rel="stylesheet" href="/modules/style/goods.css" type="text/css">
	<link rel="stylesheet" href="/modules/style/common.css" type="text/css">
	<link rel="stylesheet" href="/modules/style/bottomnav.css" type="text/css">
	<link rel="stylesheet" href="/modules/style/footer.css" type="text/css">
	
	<!--引入jqzoom css -->
	<link rel="stylesheet" href="/modules/style/jqzoom.css" type="text/css">

	<script type="text/javascript" src="/modules/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/modules/js/header.js"></script>
	<script type="text/javascript" src="/modules/js/goods.js"></script>
	<script type="text/javascript" src="/modules/js/jqzoom-core.js"></script>
	
	<!-- jqzoom 效果 -->
	<script type="text/javascript">
		$(function(){
			$('.jqzoom').jqzoom({
	            zoomType: 'standard',
	            lens:true,
	            preloadImages: false,
	            alwaysOn:false,
	            title:false,
	            zoomWidth:400,
	            zoomHeight:400
	        });
		})
	</script>
</head>
<body>
	<!-- 顶部导航 start -->
    <?php

    include_once Yii::getAlias("@app/views/common/nav.php");

    ?>
<!--	<div class="topnav">-->
<!--		<div class="topnav_bd w1210 bc">-->
<!--			<div class="topnav_left">-->
<!--				-->
<!--			</div>-->
<!--			<div class="topnav_right fr">-->
<!--				<ul>-->
<!--					<li>您好，欢迎来到京西！[<a href="login.html">登录</a>] [<a href="register.html">免费注册</a>] </li>-->
<!--					<li class="line">|</li>-->
<!--					<li>我的订单</li>-->
<!--					<li class="line">|</li>-->
<!--					<li>客户服务</li>-->
<!---->
<!--				</ul>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>

	<!-- 头部 start -->
	<div class="header w1210 bc mt15">
		<!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->

        <?php

        include_once Yii::getAlias("@app/views/common/header.php");

        ?>

		<!-- 头部上半部分 end -->
		
		<div style="clear:both;"></div>

		<!-- 导航条部分 start -->

		<!-- 导航条部分 end -->
	</div>
	<!-- 头部 end-->

	<div style="clear:both;"></div>


	<!-- 商品页面主体 start -->
	<div class="main w1210 mt10 bc">
		<!-- 面包屑导航 start -->
		<div class="breadcrumb">
			<h2>当前位置：<a href="">首页</a> > <a href="">电脑、办公</a> > <a href="">笔记本</a> > ThinkPad X230(23063T4）12.5英寸笔记本</h2>
		</div>
		<!-- 面包屑导航 end -->
		
		<!-- 主体页面左侧内容 start -->
		<div class="goods_left fl">
			<!-- 相关分类 start -->
			<div class="related_cat leftbar mt10">
				<h2><strong>相关分类</strong></h2>
				<div class="leftbar_wrap">
					<ul>
						<li><a href="">笔记本</a></li>
						<li><a href="">超极本</a></li>
						<li><a href="">平板电脑</a></li>
					</ul>
				</div>
			</div>
			<!-- 相关分类 end -->

			<!-- 热销排行 start -->
			<div class="hotgoods leftbar mt10">
				<h2><strong>热销排行榜</strong></h2>
				<div class="leftbar_wrap">
					<ul>
						<li></li>
					</ul>
				</div>
			</div>
			<!-- 热销排行 end -->


			<!-- 浏览过该商品的人还浏览了  start 注：因为和list页面newgoods样式相同，故加入了该class -->
			<div class="related_view newgoods leftbar mt10">
				<h2><strong>浏览了该商品的用户还浏览了</strong></h2>
				<div class="leftbar_wrap">
					<ul>
						<li>
							<dl>
								<dt><a href=""><img src="/modules/images/relate_view1.jpg" alt="" /></a></dt>
								<dd><a href="">ThinkPad E431(62771A7) 14英寸笔记本电脑 (i5-3230 4G 1TB 2G独显 蓝牙 win8)</a></dd>
								<dd><strong>￥5199.00</strong></dd>
							</dl>
						</li>

						<li>
							<dl>
								<dt><a href=""><img src="/modules/images/relate_view2.jpg" alt="" /></a></dt>
								<dd><a href="">ThinkPad X230i(2306-3V9） 12.5英寸笔记本电脑 （i3-3120M 4GB 500GB 7200转 蓝牙 摄像头 Win8）</a></dd>
								<dd><strong>￥5199.00</strong></dd>
							</dl>
						</li>

						<li>
							<dl>
								<dt><a href=""><img src="/modules/images/relate_view3.jpg" alt="" /></a></dt>
								<dd><a href="">T联想（Lenovo） Yoga13 II-Pro 13.3英寸超极本 （i5-4200U 4G 128G固态硬盘 摄像头 蓝牙 Win8）晧月银</a></dd>
								<dd><strong>￥7999.00</strong></dd>
							</dl>
						</li>

						<li>
							<dl>
								<dt><a href=""><img src="/modules/images/relate_view4.jpg" alt="" /></a></dt>
								<dd><a href="">联想（Lenovo） Y510p 15.6英寸笔记本电脑（i5-4200M 4G 1T 2G独显 摄像头 DVD刻录 Win8）黑色</a></dd>
								<dd><strong>￥6199.00</strong></dd>
							</dl>
						</li>

						<li class="last">
							<dl>
								<dt><a href=""><img src="/modules/images/relate_view5.jpg" alt="" /></a></dt>
								<dd><a href="">ThinkPad E530c(33662D0) 15.6英寸笔记本电脑 （i5-3210M 4G 500G NV610M 1G独显 摄像头 Win8）</a></dd>
								<dd><strong>￥4399.00</strong></dd>
							</dl>
						</li>					
					</ul>
				</div>
			</div>
			<!-- 浏览过该商品的人还浏览了  end -->

			<!-- 最近浏览 start -->
			<div class="viewd leftbar mt10">
				<h2><a href="">清空</a><strong>最近浏览过的商品</strong></h2>
				<div class="leftbar_wrap">
					<dl>
						<dt><a href=""><img src="/modules/images/hpG4.jpg" alt="" /></a></dt>
						<dd><a href="">惠普G4-1332TX 14英寸笔记...</a></dd>
					</dl>

					<dl class="last">
						<dt><a href=""><img src="/modules/images/crazy4.jpg" alt="" /></a></dt>
						<dd><a href="">直降200元！TCL正1.5匹空调</a></dd>
					</dl>
				</div>
			</div>
			<!-- 最近浏览 end -->

		</div>
		<!-- 主体页面左侧内容 end -->
		
		<!-- 商品信息内容 start -->
		<div class="goods_content fl mt10 ml10">
			<!-- 商品概要信息 start -->
			<div class="summary">
				<h3><strong><?= $good->name?></strong></h3>
				
				<!-- 图片预览区域 start -->
				<div class="preview fl">
					<div class="midpic">
                        <?php foreach ($good->gallery as $k=>$v):?>
                        <a href="<?=$v->path."?imageView2/1/w/800/h/800"?>" class="jqzoom" rel="gal1">
                        <img src="<?=$v->path."?imageView2/1/w/350/h/350"?>" alt="" />               <!-- 第一幅图片的中图
                        <?php endforeach;?>


                            <!-- 第一幅图片的大图 class 和 rel属性不能更改 -->
<!--							<img src="/modules/images/preview_m1.jpg" alt="" />               <!-- 第一幅图片的中图 -->


						</a>
					</div>
	
					<!--使用说明：此处的预览图效果有三种类型的图片，大图，中图，和小图，取得图片之后，分配到模板的时候，把第一幅图片分配到 上面的midpic 中，其中大图分配到 a 标签的href属性，中图分配到 img 的src上。 下面的smallpic 则表示小图区域，格式固定，在 a 标签的 rel属性中，分别指定了中图（smallimage）和大图（largeimage），img标签则显示小图，按此格式循环生成即可，但在第一个li上，要加上cur类，同时在第一个li 的a标签中，添加类 zoomThumbActive  -->

					<div class="smallpic">
						<a href="javascript:;" id="backward" class="off"></a>
						<a href="javascript:;" id="forward" class="on"></a>
						<div class="smallpic_wrap">
							<ul>

                                <?php foreach ($good->gallery as $k=>$v):?>

                                    <li class="<?=$k==0?"cur":""?>">
                                        <a class="<?=$k==0?"zoomThumbActive":""?>" href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '<?=$v->path."?imageView2/1/w/350/h/350"?>',largeimage: '<?=$v->path."?imageView2/1/w/800/h/800"?>'}"><img src="<?=$v->path."?imageView2/1/w/50/h/50"?>"></a>
                                    </li>
                                <?php endforeach;?>
<!--								<li class="cur">-->
<!--									<a class="zoomThumbActive" href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: 'images/preview_m1.jpg',largeimage: 'images/preview_l1.jpg'}"><img src="/modules/images/preview_s1.jpg"></a>-->
<!--								</li>-->

							</ul>
						</div>
						
					</div>
				</div>
				<!-- 图片预览区域 end -->

				<!-- 商品基本信息区域 start -->
				<div class="goodsinfo fl ml10">
					<ul>
						<li><span>商品编号： </span><?= $good->sn?></li>
						<li class="market_price"><span>定价：</span><em>￥<?= $good->market_price?>.00</em></li>
						<li class="shop_price"><span>本店价：</span> <strong>￥<?= $good->shop_price?>.00</strong> <a href="">(降价通知)</a></li>
						<li><span>上架时间：</span><?= $good->create_time?></li>
						<li class="star"><span>商品评分：</span> <strong></strong><a href="">(已有21人评价)</a></li> <!-- 此处的星级切换css即可 默认为5星 star4 表示4星 star3 表示3星 star2表示2星 star1表示1星 -->
					</ul>


					<form action="/cart/cart?" method="get" class="choose">
						<ul>
							<input type="hidden" name="id" value="<?=$good->id?>">
							<li>
								<dl>
									<dt>购买数量：</dt>
									<dd>
										<a href="javascript:;" id="reduce_num"></a>
										<input type="text" name="num" value="1" class="amount"/>
										<a href="javascript:;" id="add_num"></a>
									</dd>
								</dl>
							</li>

							<li>
								<dl>
									<dt>&nbsp;</dt>
									<dd>
										<input type="submit" value="" class="add_btn" />
									</dd>
								</dl>
							</li>

						</ul>
					</form>
				</div>
				<!-- 商品基本信息区域 end -->
			</div>
			<!-- 商品概要信息 end -->
			
			<div style="clear:both;"></div>

			<!-- 商品详情 start -->
			<div class="detail">
				<div class="detail_hd">
					<ul>
						<li class="first"><span>商品介绍</span></li>
						<li class="on"><span>商品评价</span></li>
						<li><span>售后保障</span></li>
					</ul>
				</div>
				<div class="detail_bd">
					<!-- 商品介绍 start -->
					<div class="introduce detail_div none">
						<div class="attr mt15">
							<ul>
								<li><span>商品名称：</span><?= $good->name?></li>
								<li><span>商品编号：</span><?= $good->sn?></li>
								<li><span>品牌：</span>联想（Thinkpad）</li>
								<li><span>上架时间：</span><?= $good->create_time?></li>
								<li><span>商品毛重：</span>2.47kg</li>
								<li><span>商品产地：</span>中国大陆</li>
								<li><span>显卡：</span>集成显卡</li>
								<li><span>触控：</span>非触控</li>
								<li><span>厚度：</span>正常厚度（>25mm）</li>
								<li><span>处理器：</span>Intel i5</li>
								<li><span>尺寸：</span>12英寸</li>
							</ul>
						</div>

						<div class="desc mt10">
							<!-- 此处的内容 一般是通过在线编辑器添加保存到数据库，然后直接从数据库中读出 -->

                            <?=$good->intro->content?>
<!--							<img src="/modules/images/desc1.jpg" alt="" />-->
<!--							<p style="height:10px;"></p>-->

						</div>
					</div>
					<!-- 商品介绍 end -->
					
					<!-- 商品评论 start -->
					<div class="comment detail_div mt10">
						<div class="comment_summary">
							<div class="rate fl">
								<strong><em>90</em>%</strong> <br />
								<span>好评度</span>
							</div>
							<div class="percent fl">
								<dl>
									<dt>好评（90%）</dt>
									<dd><div style="width:90px;"></div></dd>
								</dl>
								<dl>
									<dt>中评（5%）</dt>
									<dd><div style="width:5px;"></div></dd>
								</dl>
								<dl>
									<dt>差评（5%）</dt>
									<dd><div style="width:5px;" ></div></dd>
								</dl>
							</div>
							<div class="buyer fl">
								<dl>
									<dt>买家印象：</dt>
									<dd><span>屏幕大</span><em>(1953)</em></dd>
									<dd><span>外观漂亮</span><em>(786)</em></dd>
									<dd><span>系统流畅</span><em>(1091)</em></dd>
									<dd><span>功能齐全</span><em>(1109)</em></dd>
									<dd><span>反应快</span><em>(659)</em></dd>
									<dd><span>分辨率高</span><em>(824)</em></dd>
								</dl>
							</div>
						</div>

						<div class="comment_items mt10">
							<div class="user_pic">
								<dl>
									<dt><a href=""><img src="/modules/images/user1.gif" alt="" /></a></dt>
									<dd><a href="">乖乖</a></dd>
								</dl>
							</div>
							<div class="item">
								<div class="title">
									<span>2013-03-11 22:18</span>
									<strong class="star star5"></strong> <!-- star5表示5星级 start4表示4星级，以此类推 -->
								</div>
								<div class="comment_content">
									<dl>
										<dt>心得：</dt>
										<dd>东西挺好，挺满意的！</dd>
									</dl>
									<dl>
										<dt>优点：</dt>
										<dd>反应速度开，散热性能好</dd>
									</dl>
									<dl>
										<dt>不足：</dt>
										<dd>暂时还没发现缺点哦！</dd>
									</dl>
									<dl>
										<dt>购买日期：</dt>
										<dd>2013-11-24</dd>
									</dl>
								</div>
								<div class="btns">
									<a href="" class="reply">回复(0)</a>
									<a href="" class="useful">有用(0)</a>
								</div>
							</div>
							<div class="cornor"></div>
						</div>

						<div class="comment_items mt10">
							<div class="user_pic">
								<dl>
									<dt><a href=""><img src="/modules/images/user2.jpg" alt="" /></a></dt>
									<dd><a href="">小宝贝</a></dd>
								</dl>
							</div>
							<div class="item">
								<div class="title">
									<span>2013-10-01 14:10</span>
									<strong class="star star4"></strong> <!-- star5表示5星级 start4表示4星级，以此类推 -->
								</div>
								<div class="comment_content">
									<dl>
										<dt>心得：</dt>
										<dd>外观漂亮同，还在使用过程中。</dd>
									</dl>
									<dl>
										<dt>型号：</dt>
										<dd>i5 8G内存版</dd>
									</dl>
									<dl>
										<dt>购买日期：</dt>
										<dd>2013-11-20</dd>
									</dl>
								</div>
								<div class="btns">
									<a href="" class="reply">回复(0)</a>
									<a href="" class="useful">有用(0)</a>
								</div>
							</div>
							<div class="cornor"></div>
						</div>

						<div class="comment_items mt10">
							<div class="user_pic">
								<dl>
									<dt><a href=""><img src="/modules/images/user3.jpg" alt="" /></a></dt>
									<dd><a href="">天使</a></dd>
								</dl>
							</div>
							<div class="item">
								<div class="title">
									<span>2013-03-11 22:18</span>
									<strong class="star star5"></strong> <!-- star5表示5星级 start4表示4星级，以此类推 -->
								</div>
								<div class="comment_content">
									<dl>
										<dt>心得：</dt>
										<dd>挺好的，物超所值，速度挺好，WIN8用起来也不错。</dd>
									</dl>
									<dl>
										<dt>优点：</dt>
										<dd>散热很好，配置不错</dd>
									</dl>
									<dl>
										<dt>不足：</dt>
										<dd>暂时还没发现缺点哦！</dd>
									</dl>
									<dl>
										<dt>购买日期：</dt>
										<dd>2013-11-24</dd>
									</dl>
								</div>
								<div class="btns">
									<a href="" class="reply">回复(0)</a>
									<a href="" class="useful">有用(0)</a>
								</div>
							</div>
							<div class="cornor"></div>
						</div>

						<!-- 分页信息 start -->
						<div class="page mt20">
							<a href="">首页</a>
							<a href="">上一页</a>
							<a href="">1</a>
							<a href="">2</a>
							<a href="" class="cur">3</a>
							<a href="">4</a>
							<a href="">5</a>
							<a href="">下一页</a>
							<a href="">尾页</a>
						</div>
						<!-- 分页信息 end -->

						<!--  评论表单 start-->
						<div class="comment_form mt20">
							<form action="">
								<ul>
									<li>
										<label for=""> 评分：</label>
										<input type="radio" name="grade"/> <strong class="star star5"></strong>
										<input type="radio" name="grade"/> <strong class="star star4"></strong>
										<input type="radio" name="grade"/> <strong class="star star3"></strong>
										<input type="radio" name="grade"/> <strong class="star star2"></strong>
										<input type="radio" name="grade"/> <strong class="star star1"></strong>
									</li>

									<li>
										<label for="">评价内容：</label>
										<textarea name="" id="" cols="" rows=""></textarea>
									</li>
									<li>
										<label for="">&nbsp;</label>
										<input type="submit" value="提交评论"  class="comment_btn"/>										
									</li>
								</ul>
							</form>
						</div>
						<!--  评论表单 end-->
						
					</div>
					<!-- 商品评论 end -->

					<!-- 售后保障 start -->
					<div class="after_sale mt15 none detail_div">
						<div>
							<p>本产品全国联保，享受三包服务，质保期为：一年质保 <br />如因质量问题或故障，凭厂商维修中心或特约维修点的质量检测证明，享受7日内退货，15日内换货，15日以上在质保期内享受免费保修等三包服务！</p>
							<p>售后服务电话：800-898-9006 <br />品牌官方网站：http://www.lenovo.com.cn/</p>

						</div>

						<div>
							<h3>服务承诺：</h3>
							<p>本商城向您保证所售商品均为正品行货，京东自营商品自带机打发票，与商品一起寄送。凭质保证书及京东商城发票，可享受全国联保服务（奢侈品、钟表除外；奢侈品、钟表由本商城联系保修，享受法定三包售后服务），与您亲临商场选购的商品享受相同的质量保证。本商城还为您提供具有竞争力的商品价格和运费政策，请您放心购买！</p> 
							
							<p>注：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保客户收到的货物与商城图片、产地、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本商城没有及时更新，请大家谅解！</p>

						</div>
						
						<div>
							<h3>权利声明：</h3>
							<p>本商城上的所有商品信息、客户评价、商品咨询、网友讨论等内容，是京东商城重要的经营资源，未经许可，禁止非法转载使用。</p>
							<p>注：本站商品信息均来自于厂商，其真实性、准确性和合法性由信息拥有者（厂商）负责。本站不提供任何保证，并不承担任何法律责任。</p>

						</div>
					</div>
					<!-- 售后保障 end -->

				</div>
			</div>
			<!-- 商品详情 end -->

			
		</div>
		<!-- 商品信息内容 end -->
		

	</div>
	<!-- 商品页面主体 end -->
	

	<div style="clear:both;"></div>

	<!-- 底部导航 start -->
	<div class="bottomnav w1210 bc mt10">
		<div class="bnav1">
			<h3><b></b> <em>购物指南</em></h3>
			<ul>
				<li><a href="">购物流程</a></li>
				<li><a href="">会员介绍</a></li>
				<li><a href="">团购/机票/充值/点卡</a></li>
				<li><a href="">常见问题</a></li>
				<li><a href="">大家电</a></li>
				<li><a href="">联系客服</a></li>
			</ul>
		</div>
		
		<div class="bnav2">
			<h3><b></b> <em>配送方式</em></h3>
			<ul>
				<li><a href="">上门自提</a></li>
				<li><a href="">快速运输</a></li>
				<li><a href="">特快专递（EMS）</a></li>
				<li><a href="">如何送礼</a></li>
				<li><a href="">海外购物</a></li>
			</ul>
		</div>

		
		<div class="bnav3">
			<h3><b></b> <em>支付方式</em></h3>
			<ul>
				<li><a href="">货到付款</a></li>
				<li><a href="">在线支付</a></li>
				<li><a href="">分期付款</a></li>
				<li><a href="">邮局汇款</a></li>
				<li><a href="">公司转账</a></li>
			</ul>
		</div>

		<div class="bnav4">
			<h3><b></b> <em>售后服务</em></h3>
			<ul>
				<li><a href="">退换货政策</a></li>
				<li><a href="">退换货流程</a></li>
				<li><a href="">价格保护</a></li>
				<li><a href="">退款说明</a></li>
				<li><a href="">返修/退换货</a></li>
				<li><a href="">退款申请</a></li>
			</ul>
		</div>

		<div class="bnav5">
			<h3><b></b> <em>特色服务</em></h3>
			<ul>
				<li><a href="">夺宝岛</a></li>
				<li><a href="">DIY装机</a></li>
				<li><a href="">延保服务</a></li>
				<li><a href="">家电下乡</a></li>
				<li><a href="">京东礼品卡</a></li>
				<li><a href="">能效补贴</a></li>
			</ul>
		</div>
	</div>
	<!-- 底部导航 end -->

	<div style="clear:both;"></div>
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt10">
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

	<script type="text/javascript">
		document.execCommand("BackgroundImageCache", false, true);
	</script>
</body>
</html>