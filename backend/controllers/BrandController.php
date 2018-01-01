<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\data\Pagination;
use yii\web\UploadedFile;

class BrandController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $brand = Brand::find()->orderBy('id')->where(['status'=>1]);
        $count = $brand->count();
        $pagination = new Pagination(
            ['totalCount' => $count, 'pageSize' => 3]

        );
        $brands = $brand->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',compact('brands','content','pagination'));


    }

    public function actionAdd()
    {

        $model = new Brand();


        $request = \Yii::$app->request;

        if ($request->isPost) {

            $model->load($request->post());

            $model->logoFile=UploadedFile::getInstance($model,'logoFile');

//            var_dump($model->logoFile);exit;
            $path='';
            if ($model->validate()) {

                $path = 'images/brand/'.uniqid().'.'.$model->logoFile->extension;
//                var_dump($path);exit;
                $model->logoFile->saveAs($path,false);
            }
            $model->logo=$path;
            if ($model->save()) {

                return $this->redirect(['brand/index']);
            }

        }


        return $this->render('add', ['model' => $model]);

    }

    public function actionEdit($id)
    {

        $model = Brand::findOne($id);


        $request = \Yii::$app->request;

        if ($request->isPost) {

            $model->load($request->post());

            $model->logoFile=UploadedFile::getInstance($model,'logoFile');

//            var_dump($model->logoFile);exit;
            $path=$model->logo;

            if ($path) {
               unlink($path);
            }
            if ($model->validate()) {

                $path = 'images/brand/'.uniqid().'.'.$model->logoFile->extension;
//                var_dump($path);exit;
                $model->logoFile->saveAs($path,false);
            }

            $model->logo=$path;
            if ($model->save()) {

                return $this->redirect(['brand/index']);
            }

        }


        return $this->render('add', ['model' => $model]);

    }

    public function actionDel($id)
    {
        $url = \Yii::getAlias('@webroot/').Brand::findOne($id)->logo;

//            var_dump(111);exit;
        if (Brand::findOne($id)->delete()) {
            if (is_file($url)) {
                unlink($url);
            }
           return $this->redirect(['brand/index']);
        }

    }

    public function actionRcl(){
        
        $brand = Brand::find()->where(['status'=>2]);
        $count = $brand->count();
        $pagination = new Pagination(
            ['totalCount' => $count, 'pageSize' => 3]
        );
        $brands = $brand->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('rcl',compact('brands','content','pagination'));


    }

    public function actionDal($id)
    {
        $brand = Brand::findOne($id);

        $brand->status=2;

        if ($brand->save(false)) {
            return $this->redirect(['index']);
        }


    }

    public function actionDelrcl($id)
    {

        $brand = Brand::findOne($id);

        $brand->status=1;

        if ($brand->save(false)){

            return $this->redirect(['index']);
        }

    }

}
