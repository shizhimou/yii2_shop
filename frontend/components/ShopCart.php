<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/12
 * Time: 14:20
 */

namespace frontend\components;


use backend\models\Goods;
use frontend\models\Cart;
use yii\base\Component;
use yii\web\Cookie;

class ShopCart extends Component
{

    private $_getCookie=[];
    public function __construct(array $config = [])
    {

        $this->_getCookie = \Yii::$app->request->cookies->getValue("cart",[]);
        parent::__construct($config);
    }

    public function add($id,$num)
    {
        if(array_key_exists($id,$this->_getCookie)){
            $this->_getCookie[$id] = $this->_getCookie[$id]+$num;
//                var_dump($getCookie);exit;
        }else{

            $this->_getCookie[$id]=$num;
//                var_dump($getCookie);exit;
        }

        return $this;
    }

    public function save()
    {
        //设置执行对象
        $setCookie = \Yii::$app->response->cookies;

        $cookie = new Cookie([

            'name'=>'cart',
            'value'=>$this->_getCookie,
            'expire' => time()+3600*24*30
        ]);
        //设置Cookie
        $setCookie->add($cookie);

        return $this;
    }

    public function update($id,$num)
    {
        $this->_getCookie[$id]=$num;
        return $this;
//        var_dump($getCookie);exit;
    }
//删除购物车
    public function del($id)
    {

        unset($this->_getCookie[$id]);
        return $this;
     }
    //显示购物车
    public function lists()
    {

       $this->_getCookie;
        return $this;
    }
//登录后清空购物车
    public function flush()
    {
        $this->_getCookie=[];
        return $this;
    }
    
    //登陆后把本地的数据同步到数据库
    public function todb()
    {

        foreach ($this->_getCookie as $id=>$num){


            $carts = Cart::find()->where(['goods_id'=>$id,'user_id'=>\Yii::$app->user->id])->one();
//            var_dump($carts->num);exit;
            if ($carts){
//                var_dump(11);exit;
                $carts->num= $carts->num + $num;
                $carts->save();
            }else{
                $cart = new Cart();
                $cart->num=$num;
                $cart->goods_id= $id;
                $cart->user_id= \Yii::$app->user->id;
//                var_dump($cart->num);
                $cart->save();

            }
        }
    }

}