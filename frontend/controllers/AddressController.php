<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/12
 * Time: 11:53
 */

namespace frontend\controllers;


use frontend\models\Address;
use yii\helpers\Json;
use yii\web\Controller;

class AddressController extends Controller
{
    public $enableCsrfValidation=false;
    //收货地址 添加、修改
    public function actionAddress()
    {


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
                $new->status = $request->post()['check'];
                if ($request->post()['check']=="on"){
                    $add = Address::find()->where(['status'=>1])->all();
//                    var_dump($add);exit;
                    foreach ($add as $a){
                        $a->status = 2;
//                        var_dump($a);exit;
                        $a->save();
                    }

                    $new->status = 1;
                }else{
                    $new->status = 2;
                }
//                var_dump($new->status);exit;
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

//                var_dump($add);exit;
                $address = new Address();
                $address->user_id =\Yii::$app->user->id;
                $address->username = $request->post()['username'];
                $address->address = $request->post()['province3'].$request->post()['city3'].$request->post()['area3'].$request->post()['address'];
                $address->tel=$request->post()['tel'];
//                ($request->post()['check']=="on")?$address->status = 1:$address->status = 2;
                if ($request->post()['check']=="on"){
                    $add = Address::find()->where(['status'=>1])->all();
//                    var_dump($add);exit;
                    foreach ($add as $a){
                        $a->status = 2;
//                        var_dump($a);exit;
                        $a->save();
                    }

                    $address->status = 1;
                }else{
                    $address->status = 2;
                }

//                ($request->post()['check']=="on")?
//                if($request->post()['check']=="on"){
//                    $address->status = 1;
//                }else{
//                    $address->status = 2;
//                }

//                var_dump($address->status);exit;
//
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

        $info = Address::find()->where(['user_id'=>\Yii::$app->user->id])->all();

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