<div class="topnav">
    <div class="topnav_bd w1210 bc">
        <div class="topnav_left">

        </div>
        <div class="topnav_right fr">
            <ul>

                <li><?php if(Yii::$app->user->isGuest){

                        echo  '[<a href="http://www.web.com/user/login">登录</a>] [<a href="http://www.web.com/user/regist">免费注册</a>]';

                    }else{

                        echo '欢迎'.'['.Yii::$app->user->identity->username.']';

                          echo  '[<a href="http://www.web.com/user/logout">注销</a>]';

                    }?> </li>
                <li class="line">|</li>
                <li><a href="/order/index">我的订单</a></li>
                <li class="line">|</li>
                <li>客户服务</li>

            </ul>
        </div>
    </div>
</div>