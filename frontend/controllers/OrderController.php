<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/12
 * Time: 14:52
 */

namespace frontend\controllers;


use backend\models\Goods;
use frontend\models\Address;
use frontend\models\Cart;
use frontend\models\Order;
use frontend\models\OrderDetail;
use yii\helpers\Json;
use yii\web\Controller;

class OrderController extends Controller
{
    public $enableCsrfValidation=false;
    public function actionLists()
    {


        if (\Yii::$app->user->isGuest) {

          return $this->redirect(['user/login']);

        }else{

            $request= \Yii::$app->request;
            $num = $request->post()['amount'];
            $goods = $request->post()['check'];
            foreach ($goods as $v){
                $arr[]=(int)$v;
            }

//            var_dump($arr);exit;
//            $orderone = OrderDetail::find()->where(['in','goods_id',$goods])->all();
            $cart = Cart::find()->where(['in','goods_id',$goods])->all();


            foreach ($cart as $car){
//                var_dump($or);
                  $car->delete();
            }
//            exit;
//            var_dump($orderone);exit;

            $goods=Goods::find()->where(['in','id',$goods])->asArray()->all();
//            $order = new Order();

            foreach ($goods as $k=>$v){
                $goods[$k]['num'] = $num[$k];
//                if (!$orderone){
                    $order = new OrderDetail();
                    $order->order_info_id = $goods[$k]['id'];
                    $order->goods_id = $goods[$k]['id'];
                    $order->goods_name = $goods[$k]['name'];
                    $order->logo = $goods[$k]['logo'];
                    $order->price = $goods[$k]['shop_price'];
                    $order->amount = $goods[$k]['num'];
                    $order->total_price = $goods[$k]['num']*$goods[$k]['shop_price'];
                    $order->save();
//                }
            }


//            var_dump($goods);exit;
                $info = Address::find()->where(['user_id'=>\Yii::$app->user->id])->all();
                return $this->render('cart2',['goods'=>$goods,'info'=>$info]);
        }
    }

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
    public function actionIndex()
    {
        $order = Order::find()->where(['user_id'=>\Yii::$app->user->id])->all();

        return $this->render('order',compact('order'));
}

}