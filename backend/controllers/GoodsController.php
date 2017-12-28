<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsIntro;
use flyok666\qiniu\Qiniu;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class GoodsController extends \yii\web\Controller
{

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
//                'config' => [
//                    "imageUrlPrefix"  => "http://www.baidu.com",//图片访问路径前缀
//                    "imagePathFormat" => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}", //上传保存路径
//                "imageRoot" => \Yii::getAlias("@webroot"),
            ],
//        ]
        ];
    }

    public function actionIndex()
    {
        $good = Goods::find()->orderBy('id');
        $count = $good->count();
        $pagination = new Pagination(
            ['totalCount' => $count, 'pageSize' => 3]

        );
        $goods = $good->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render('index', ['pagination' => $pagination, 'goods' => $goods]);
    }

    public function actionAdd()
    {

        $type = GoodsCategory::find()->asArray()->all();
        $types = ArrayHelper::map($type,'id','name');
        $brand = Brand::find()->asArray()->all();
        $brands = ArrayHelper::map($brand,'id','name');
        $model = new Goods();
        $request = \Yii::$app->request;

        if ($request->isPost) {

           $model->load($request->post());

            if ($model->validate()) {
                $model->create_time=date('Y-m-d H:i:s',time());
//                echo '<pre>';
                var_dump($model->getErrors());

                $num =Goods::find()->max('sn');

                if ($num==null) {
                   $num='0000';
                }
//                var_dump($num);exit;
                $num = substr($num,-4);
                $num = intval($num);
                $num = $num+1;
                $num =strval($num);
//                $num =strlen($num);
                if(strlen($num)==1){
                   $sn = '000';
                   $model->sn=date('Ymd'.$sn.$num,time());
//                    var_dump($model->sn);exit;
                }elseif (strlen($num)==2){
                    $sn = '00';
                    $model->sn=date('Ymd'.$sn.$num,time());
                }elseif (strlen($num)==3){
                    $sn = '0';
                    $model->sn=date('Ymd'.$sn.$num,time());
                }else{
                    $model->sn=date('Ymd'.$num,time());
                }
//                var_dump($model->sn);exit;
            }
            $model->save();

        }

        $content = new GoodsIntro();
        if ($request->isPost) {

            $content->load($request->post());

            if ($content->validate()) {
                $content->goods_id = $model->id;
                var_dump($content->getErrors());
            }
            $content->save();
            \Yii::$app->session->setFlash('success','添加商品成功');
            return $this->redirect(['goods/index']);
        }

        return $this->render('add', ['model' => $model, 'content' => $content,'types'=>$types,'brands'=>$brands]);
    }

    public function actionEdit($id)
    {


        $type = GoodsCategory::find()->asArray()->all();
        $types = ArrayHelper::map($type,'id','name');
        $brand = Brand::find()->asArray()->all();
        $brands = ArrayHelper::map($brand,'id','name');
        $model = Goods::findOne($id);
        $request = \Yii::$app->request;

        if ($request->isPost) {

            $model->load($request->post());

            if ($model->validate()) {
                $model->create_time=date('Y-m-d H:i:s',time());
//                echo '<pre>';
                var_dump($model->getErrors());

                $num =Goods::find()->max('sn');

                if ($num==null) {
                    $num='0000';
                }
//                var_dump($num);exit;
                $num = substr($num,-4);
                $num = intval($num);
                $num = $num+1;
                $num =strval($num);
//                $num =strlen($num);
                if(strlen($num)==1){
                    $sn = '000';
                    $model->sn=date('Ymd'.$sn.$num,time());
//                    var_dump($model->sn);exit;
                }elseif (strlen($num)==2){
                    $sn = '00';
                    $model->sn=date('Ymd'.$sn.$num,time());
                }elseif (strlen($num)==3){
                    $sn = '0';
                    $model->sn=date('Ymd'.$sn.$num,time());
                }else{
                    $model->sn=date('Ymd'.$num,time());
                }
//                var_dump($model->sn);exit;
            }
            $model->save();

        }

        $content = GoodsIntro::findOne($id);
        if ($request->isPost) {
            $content->load($request->post());
            if ($content->validate()) {
                $content->goods_id = $model->id;
                var_dump($content->getErrors());
            }
            $content->save();
            \Yii::$app->session->setFlash('success','添加商品成功');
            return $this->redirect(['goods/index']);
        }

        return $this->render('add', ['model' => $model, 'content' => $content,'types'=>$types,'brands'=>$brands]);
    }

    public function actionContent($id)
    {
        $content = GoodsIntro::findOne($id);

        $request = \Yii::$app->request;
        if ($request->isPost) {
            $content->load($request->post());
            if ($content->validate()) {
                $content->save();
                return $this->redirect(['index']);
            }

        }

        return $this->render('content',compact('content'));

    }

    public function actionUploads()
    {
        $config = [
            'accessKey' => 'q_rcZdza58NonrULcS_feNKfk893O8lq6oxF1Omv',
            'secretKey' => 'I7ztXLwTOSTOcWY8svGLxhFZzsVcEiXiHvjZP9ed',
            'domain' => 'http://p1jrt03ee.bkt.clouddn.com',
            'bucket' => 'yii2',
            'area' => Qiniu::AREA_HUADONG
        ];
        $qiniu = new Qiniu($config);
//var_dump($qiniu);exit;
        $key = time();
//        var_dump($_FILES);exit;
        $qiniu->uploadFile($_FILES['file']["tmp_name"], $key);
        $url = $qiniu->getLink($key);
        $result = [
            'code' => 0,
            'url' => $url,
            'attachment' => $url

        ];
        echo json_encode($result);

    }

}
