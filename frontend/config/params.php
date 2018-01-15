<?php
return [
    'SendType'=>[
         ['type'=>'普通快递送货上门','money'=>'￥10.00','intro'=>'每张订单不满499.00元,运费15.00元, 订单4...'],
         ['type'=>'特快专递','money'=>'￥40.00','intro'=>'每张订单不满499.00元,运费40.00元, 订单4...'],
         ['type'=>'加急快递送货上门','money'=>'￥40.00','intro'=>'每张订单不满499.00元,运费15.00元, 订单4...'],
         ['type'=>'平邮','money'=>'￥10.00','intro'=>'每张订单不满499.00元,运费15.00元, 订单4...'],

    ],

    'PayType'=>[
      ['type'=>'货到付款','intro'=>'送货上门后再收款，支持现金、POS机刷卡、支票支付'],
      ['type'=>'在线支付','intro'=>'即时到帐，支持绝大数银行借记卡及部分银行信用卡'],
      ['type'=>'上门自提','intro'=>'自提时付款，支持现金、POS刷卡、支票支付'],
      ['type'=>'邮局汇款','intro'=>'通过快钱平台收款 汇款后1-3个工作日到账']
    ],
    'adminEmail' => 'admin@example.com',
    'easyWeCart'=>[
        /**
         * Debug 模式，bool 值：true/false
         *
         * 当值为 false 时，所有的日志都不会记录
         */
        'debug'  => true,

        /**
         * 账号基本信息，请从微信公众平台/开放平台获取
         */
        'app_id'  => 'wx85adc8c943b8a477',         // AppID
        'secret'  => 'a687728a72a825812d34f307b630097b',     // AppSecret
        //'token'   => 'your-token',          // Token
        //'aes_key' => '',                    // EncodingAESKey，安全模式与兼容模式下请一定要填写！！！

        /**
         * 日志配置
         *
         * level: 日志级别, 可选为：
         *         debug/info/notice/warning/error/critical/alert/emergency
         * permission：日志文件权限(可选)，默认为null（若为null值,monolog会取0644）
         * file：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log' => [
            'level'=> 'debug',
            'permission'=> 0777,
            'file'=> '/tmp/easywechat.log',
        ],

        /**
         * OAuth 配置
         *
         * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
         * callback：OAuth授权完成后的回调页地址
         */
//            'oauth' => [
//                'scopes'   => ['snsapi_userinfo'],
//                'callback' => '/examples/oauth_callback.php',
//            ],

        /**
         * 微信支付
         */
        'payment' => [
            'merchant_id'        => '1228531002',
            'key'                => 'a687728a72a825812d34f307b630097b',
            //'cert_path'          => 'path/to/your/cert.pem', // XXX: 绝对路径！！！！
            //'key_path'           => 'path/to/your/key',      // XXX: 绝对路径！！！！
            // 'device_info'     => '013467007045764',
            // 'sub_app_id'      => '',
            // 'sub_merchant_id' => '',
            // ...



        ],

        /**
         * Guzzle 全局设置
         *
         * 更多请参考： http://docs.guzzlephp.org/en/latest/request-options.html
         */
        'guzzle' => [
            'timeout' => 3.0, // 超时时间（秒）
            'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
        ],
    ]
];
