<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/12
 * Time: 11:38
 */

namespace frontend\controllers;


use backend\models\Goods;
use frontend\components\ShopCart;
use frontend\models\Address;
use frontend\models\Cart;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Cookie;

class CartController  extends Controller
{

    public $enableCsrfValidation=false;
//添加购物车
    public function actionCart($id,$num)
    {
        if (\Yii::$app->user->isGuest) {
            //判定是否存在cookie 存在修改 不存在新增

//            $getCookie = \Yii::$app->request->cookies->getValue("cart",[]);
//            if(array_key_exists($id,$getCookie)){
//                $getCookie[$id] = $getCookie[$id]+$num;
////                var_dump($getCookie);exit;
//            }else{
//
//                $getCookie[$id]=$num;
////                var_dump($getCookie);exit;
//            }
//
//            //设置执行对象
//            $setCookie = \Yii::$app->response->cookies;
//
//            $cookie = new Cookie([
//
//                'name'=>'cart',
//                'value'=>$getCookie,
//                'expire' => time()+3600*24*30
//            ]);
//
//            //设置Cookie
//            $setCookie->add($cookie);
            $cart = new ShopCart();
            $cart->add($id,$num)->save();

            return $this->redirect(['cart/lists']);
        }else{

            $cart = new Cart();
//            var_dump(\Yii::$app->user->id);
            $carts = Cart::find()->where(['goods_id'=>$id,'user_id'=>\Yii::$app->user->id])->one();
//            var_dump($carts->num);exit;
            if ($carts){
//                var_dump(11);exit;
                $carts->num= $carts->num + $num;
                $carts->save();
            }else{
                $cart->num=$num;
                $cart->goods_id= $id;
                $cart->user_id= \Yii::$app->user->id;
//                var_dump($cart->num);
                $cart->save();

            }

            return $this->redirect(['cart/lists']);

        }


    }
    //显示购物车
    public function actionLists()
    {
        if (\Yii::$app->user->isGuest) {
            //判定是否存在cookie 存在修改 不存在新增

            $getCookie = \Yii::$app->request->cookies->getValue("cart",[]);
//            var_dump($getCookie);exit;

            //获取所有的cookie购物id
            $cartId=array_keys($getCookie);
            $goods = Goods::find()->andWhere(['in','id',$cartId])->asArray()->all();
//            var_dump($goods);exit;

            foreach ($goods as $k=>$v){

                $goods[$k]['num'] = $getCookie[$v['id']];
//                var_dump($goods[$k]['num']);exit;
            }
////            var_dump($goods);exit;
//
//            //设置执行对象
//            $setCookie = \Yii::$app->response->cookies;
//
//            $cookie = new Cookie([
//
//                'name'=>'cart',
//                'value'=>$getCookie,
//                'expire' => time()+3600*24*30
//            ]);
//
//            //设置Cookie
//            $setCookie->add($cookie);
            $cart = new ShopCart();
            $cart->lists()->save();
            return $this->render('cart',compact('goods'));
        }else{

            $carts = Cart::find()->where(['user_id'=>\Yii::$app->user->id])->asArray()->orderBy('goods_id')->all();
            $carts =ArrayHelper::map($carts,'id','goods_id');
//            var_dump($carts);exit;
            $goods = Goods::find()->orWhere(["in","id",$carts])->asArray()->all();
//            var_dump($goods);exit;
            $cart = Cart::find()->where(['user_id'=>\Yii::$app->user->id])->asArray()->orderBy('goods_id')->all();
            foreach ($goods as $good=>$v){
                $goods[$good]['num'] = $cart[$good]['num'];
            }


//            var_dump($goods);exit;
            return $this->render('cart',compact('goods'));
        }



    }
    //修改购物车
    public function actionUpdateCart($id,$num)
    {

        if (\Yii::$app->user->isGuest) {
            //判定是否存在cookie 存在修改 不存在新增

//            $getCookie = \Yii::$app->request->cookies->getValue("cart",[]);
////                var_dump($getCookie);exit;
//            $getCookie[$id]=$num;
////                var_dump($getCookie);exit;
//
//            //设置执行对象
//            $setCookie = \Yii::$app->response->cookies;
//
//            $cookie = new Cookie([
//
//                'name'=>'cart',
//                'value'=>$getCookie,
//                'expire' => time()+3600*24*30
//            ]);
//
//            //设置Cookie
//            $setCookie->add($cookie);
//            return 1;
            $cart = new ShopCart();
            $cart->update($id,$num)->save();


        }else{
            $carts = Cart::find()->where(['goods_id'=>$id,'user_id'=>\Yii::$app->user->id])->one();
            $carts->num= $num;
            $carts->save();
            return  Json::encode($carts);
        }
    }
    //删除购物车
    public function actionDelCart($id)
    {
        if (\Yii::$app->user->isGuest) {
            //判定是否存在cookie 存在修改 不存在新增
//var_dump($id);exit;
//            $getCookie = \Yii::$app->request->cookies->getValue("cart",[]);
////                var_dump($getCookie);exit;
//            unset($getCookie[$id]);
////                var_dump($getCookie);exit;
//
//            //设置执行对象
//            $setCookie = \Yii::$app->response->cookies;
//
//            $cookie = new Cookie([
//
//                'name'=>'cart',
//                'value'=>$getCookie,
//                'expire' => time()+3600*24*30
//            ]);
//
//            //设置Cookie
//            $setCookie->add($cookie);
//            return 1;
            $cart = new ShopCart();
            $cart->del($id)->save();

            return $this->redirect(['cart/lists']);
        }else{

            $carts = Cart::find()->where(['goods_id'=>$id,'user_id'=>\Yii::$app->user->id])->one();
            $carts->delete();
            return $this->redirect(['cart/lists']);
        }


    }


}