<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/12
 * Time: 14:52
 */

namespace frontend\controllers;


use backend\models\Goods;
use dosamigos\qrcode\lib\Enum;
use dosamigos\qrcode\QrCode;
use EasyWeChat\Foundation\Application;
use frontend\models\Address;
use frontend\models\Cart;
use frontend\models\Order;
use frontend\models\OrderDetail;
use yii\db\Exception;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;


class OrderController extends Controller
{
    public $enableCsrfValidation=false;
    //订单详情
    public function actionLists()
    {


        if (\Yii::$app->user->isGuest) {

          return $this->redirect(['user/login']);

        }else {

            $request = \Yii::$app->request;

            $num = $request->post()['amount'];
            $goods = $request->post()['check'];
            foreach ($goods as $v) {
                $arr[] = (int)$v;
            }

//            var_dump($arr);exit;
//            $orderone = OrderDetail::find()->where(['in','goods_id',$goods])->all();
            //清空购物车
            $cart = Cart::find()->where(['in', 'goods_id', $goods])->all();
            foreach ($cart as $car) {
//                var_dump($or);
                $car->delete();
            }
//            exit;
//            var_dump($orderone);exit;

            $goods = Goods::find()->where(['in', 'id', $goods])->asArray()->all();
//            $order = new Order();
//            if($request->isPost){
            $db = \Yii::$app->db;
            $transaction = $db->beginTransaction();

            try {

                foreach ($goods as $k => $v) {
                    $goods[$k]['num'] = $num[$k];

                    $stock = Goods::findOne($goods[$k]['id'])->stock;
                    if ($goods[$k]['num'] > $stock) {
                        throw new Exception("库存不足");
                    }
//                if (!$orderone){
                    $order = new OrderDetail();

                    $orders = Order::find()->max('id');
//                    var_dump($orders);exit;
                    if ($orders===null){
                        $order->order_info_id = 1;
//                        var_dump($order->order_info_id);exit;
                    }else{
                        $order->order_info_id = $orders+1;
                    }
//                    var_dump($order->order_info_id);exit;

                    $order->goods_id = $goods[$k]['id'];
                    $order->goods_name = $goods[$k]['name'];
                    $order->logo = $goods[$k]['logo'];
                    $order->price = $goods[$k]['shop_price'];
                    $order->amount = $goods[$k]['num'];
                    $order->total_price = $goods[$k]['num'] * $goods[$k]['shop_price'];
                    if ($order->save()) {
                        Goods::updateAllCounters(['stock' => -$goods[$k]['num']], ['id' => $goods[$k]['id']]);
                    }
//                }

                    $transaction->commit();
                }
            } catch (Exception $e) {

                $transaction->rollBack();
                exit($e->getMessage());
            }
            $id = Order::find()->where(['user_id' => \Yii::$app->user->id])->max('id');
//
//           return $this->render('finish');
//            }
//            var_dump($goods);exit;
                $info = Address::find()->where(['user_id'=>\Yii::$app->user->id])->all();

                return $this->render('cart2',['goods'=>$goods,'info'=>$info]);
        }
    }
//订单表
    public function actionOrders()
    {

      $order = new Order();
      $request = \Yii::$app->request;

//        var_dump($_GET);
//     var_dump($request->post()['address_id']);exit;
       $id =  $request->post()['address_id'];
       $money =  $request->post()['delivery'];
       $pay =  $request->post()['pay'];
       $all = $request->post()['money'];
       $order->price=$all;
       $order->pay_type_name=$pay;
       $money = str_replace("￥","",$money);
       $money=intval($money);
//       var_dump($money);exit;
       $order->delivery_price=$money;
      $add = Address::find()->where(['id'=>$id,'user_id'=>\Yii::$app->user->id])->one();
      $order->detail_address = $add->address;
      $order->delivery_name=$add->username;
//      var_dump($add->tel);exit;
      $order->tel = $add->tel;
      $order->user_id=\Yii::$app->user->id;
      $order->sn = date("Ymd",time()).time();
      $order->create_time = time();
      $order->status=2;
      $order->save();
//      var_dump($order->sn);exit;

        return $order->id;
    }

//    public function actionDetail()
//    {
//        $arr = [];
//         foreach ($_GET as $id){
//             $arr[]=$id;
//         }
////         var_dump($arr);
//
//   }
    public function actionCarts($id)
    {
        return $this->render('cart3',compact('id'));
    }
    public function actionIndex()
    {
        $order = Order::find()->where(['user_id'=>\Yii::$app->user->id])->all();

        return $this->render('order',compact('order'));
    }


    public function actionWxPay($id)
    {

         //查询当前订单
//        $id = Order::find()->where(['user_id'=>\Yii::$app->user->id])->max('id');
        $Goodsorder = Order::findOne($id);

//      var_dump($Goodsorder->sn);exit;
        $app = new Application(\Yii::$app->params['easyWeCart']);

        $payment = $app->payment;



        $attributes = [
            'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP...
            'body'             => 'moumou',
            'detail'           => 'iPad mini 16G 白色',
            'out_trade_no'     => $Goodsorder->sn,//$Goodsorder->price*100
            'total_fee'        => 1, // 单位：分
            'notify_url'       => Url::to(['order/notify'],true), // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            //'openid'           => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
//        $attributes = [
//            'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP...
//            'body'             => 'iPad mini 16G 白色',
//            'detail'           => 'iPad mini 16G 白色',
//            'out_trade_no'     => $Goodsorder->,
//            'total_fee'        => 5388, // 单位：分
//            'notify_url'       => 'http://xxx.com/order-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
//            //'sub_openid'        => '当前用户的 openid', // 如果传入sub_openid, 请在实例化Application时, 同时传入$sub_app_id, $sub_merchant_id
//            // ...
//        ];
         $order = new \EasyWeChat\Payment\Order($attributes);

         //统一下单

        $result = $payment->prepare($order);
//        var_dump($result);exit;
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
//            $prepayId = $result->prepay_id;
            return QrCode::png($result->code_url,false,Enum::QR_ECLEVEL_H,6);
        }else{
            var_dump($result);
        }
//        return $this->render('finish');
    }


//    public function actionFinish($id)
//    {
//    return $this->render('finish',compact('id'));
//    }

    public function actionNotify()
    {
        $app = new Application(\Yii::$app->params['easyWeCart']);
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order = Order::findOne(['sn'=>$notify->out_trade_no]);
//            var_dump($order);exit;
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status!=2) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }

            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                $order->create_time = time(); // 更新支付时间为当前时间
                $order->status = 1;
            }

            $order->save(); // 保存订单

            return true; // 返回处理完成
        });

        return $response;
    }

    public function actionClean()
    {
        while (true){
        //找到未支付1订单时间小于15分钟的所有订单
        $orders = Order::find()->where(['status'=>2])->andWhere(['<','create_time',time()-5])->all();
        //找到所有的订单id
        $orderIDs = array_column($orders,'id');
        //把存在的订单Id改为取消状态
//        var_dump($orderID);exit;
        Order::updateAll(['status'=>0],['in','id',$orderIDs]);
        //还原库存
        foreach ($orderIDs as $id){
            $details = OrderDetail::find()->where(['order_info_id'=>$id])->all();
            foreach ($details as $detail){
                Goods::updateAllCounters(['stock'=>$detail->amount],['id'=>$detail->goods_id]);
            }
        }
//        var_dump(implode(',',$orderIDs));exit;
        if($orderIDs){
            echo implode(",",$orderIDs)." complete ok".PHP_EOL;;
        }
        sleep(5);
        }
    }
}