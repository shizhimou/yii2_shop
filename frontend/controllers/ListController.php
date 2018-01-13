<?php

namespace frontend\controllers;

use backend\models\Goods;
use backend\models\GoodsCategory;
use frontend\models\Address;
use frontend\models\Cart;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Cookie;

class ListController extends \yii\web\Controller
{
    public $enableCsrfValidation=false;
    //显示商品列表
    public function actionIndex($id)
    {
//        var_dump($id);exit;
        $cats = GoodsCategory::find()->andWhere(['parent_id' => $id])->all();
        foreach ($cats as $cat) {
        }
        if (!empty($cat->id)) {
//            var_dump(222);exit;
            $cata = GoodsCategory::find()->andWhere(['parent_id' => $cat->id])->all();
            foreach ($cata as $catb) {
            }
            if (!empty($catb->id)) {
                $goods= Goods::find()
                    ->orWhere(["goods_category_id"=>$id])
                    ->orWhere(["goods_category_id"=>$cat->id])
                    ->orWhere(["goods_category_id"=>$catb->id])
                    ->all();
                return $this->render('index', compact('goods'));
            }else{
              $goods= Goods::find()
                    ->orWhere(["goods_category_id"=>$id])
                    ->orWhere(["goods_category_id"=>$cat->id])
                    ->all();
//              var_dump($goods);exit;
                return $this->render('index', compact('goods'));
            }

        }else{
//            var_dump(333);exit;
            $goods = Goods::find()->where(['goods_category_id'=>$id])->all();
//            var_dump($goods);exit;
            return $this->render('index', compact('goods'));
        }



    }
    //显示商品详情
    public function actionGoods($id)
    {
       $goods =  Goods::find()->where(['id'=>$id])->all();
       foreach ($goods as $good){

       }
       if($good){
           return $this->render('goods.php',compact('good'));
       }else{
           $good=[];
           return $this->render('goods.php',compact('good'));
       }
//       var_dump($good->logo);exit;

    }
    //收货地址 添加、修改
    public function actionAddress()
    {
        $address = new Address();
        $request = \Yii::$app->request;
//        var_dump($address);exit;
        if ($request->isPost) {
            if ($request->post()['id']){
                $new = Address::findOne($request->post()['id']);
//              var_dump($new);exit;
                $new->user_id =\Yii::$app->user->id;
                $new->username = $request->post()['username'];
                $new->address = $request->post()['province3'].$request->post()['city3'].$request->post()['area3'].$request->post()['address'];
                $new->tel=$request->post()['tel'];
//                    var_dump($request->post());exit;
                if ($new->save()) {
                    return Json::encode(
                        [
                            'status'=>2,
                            'data'=>$new
                        ]
                    );
                }


            }else{
                $address->user_id =\Yii::$app->user->id;
                $address->username = $request->post()['username'];
                $address->address = $request->post()['province3'].$request->post()['city3'].$request->post()['area3'].$request->post()['address'];
                $address->tel=$request->post()['tel'];
                if ($address->validate()){
                    if ($address->save()) {
                        return Json::encode(
                            [
                                'status'=>1,
                                'data'=>$address
                            ]
                        );
                    }

                }
            }


        }

         $info = Address::find()->all();

            return $this->render('address',compact('info'));

    }
    //修改地址
    public function actionUpdateAddress($id)
    {
//        $info = Address::find()->all();
        $address = Address::findOne($id);


//          return $this->render('address', ['address'=>$address]);
        return Json::encode($address);
//        var_dump($address);exit;
    }
    //删除地址
    public function actionDelAddress($id)
    {
//        var_dump($id);exit;
       $address = Address::findOne($id)->delete();

       return 0;
    }


}
