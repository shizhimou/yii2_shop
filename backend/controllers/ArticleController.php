<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleContent;
use backend\models\ArticleType;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        echo date('H:i:s',time());
        $articles = Article::find()->orderBy('id')->all();

        return $this->render('index',compact('articles','content'));
    }

    public function actionAdd()
    {
//        echo '<pre>';
        $model = new Article();
//        var_dump($model);exit;
        $type = ArticleType::find()->asArray()->all();
        $types = ArrayHelper::map($type,'id','type');

        $request  = \Yii::$app->request;
        if($request->isPost){
            //绑定数据
            $model->load($request->post());
            $path='';
            if ($model->validate()) {
            }
                $model->create_time = time();
                if ($model->save(false)) {
//                    \Yii::$app->session->setFlash('success','添加文章成功');
//                    var_dump($model->id);exit;
                }

            }

        $content = new ArticleContent();
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $content->load($request->post());
            if ($content->validate()) {
                $content->id = $model->id;
//                var_dump($content->id);exit;
                $content->save();
                return $this->redirect(['index']);
            }

        }


        return $this->render('add', ['model' => $model,'types'=>$types,'content'=>$content]);
    }

    public function actionEdit($id)
    {
//        echo '<pre>';
        $model = Article::findOne($id);
//        var_dump($model);exit;
        $type = ArticleType::find()->asArray()->all();
        $types = ArrayHelper::map($type,'id','type');

        $request  = \Yii::$app->request;
        if($request->isPost){
            //绑定数据
            $model->load($request->post());
            $path='';
            if ($model->validate()) {
            }
            $model->create_time = time();
            if ($model->save(false)) {
//                    \Yii::$app->session->setFlash('success','添加文章成功');
//                    var_dump($model->id);exit;
            }

        }

        $content = ArticleContent::findOne($id);
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $content->load($request->post());
            if ($content->validate()) {
                $content->id = $model->id;
//                var_dump($content->id);exit;
                $content->save();
                return $this->redirect(['index']);
            }

        }


        return $this->render('add', ['model' => $model,'types'=>$types,'content'=>$content]);
    }

    public function actionDel($id)
    {

        $type = ArticleContent::find()->all();
        if ($model = Article::findOne($id)->delete()) {
            return $this->redirect(['index']);
        }

    }

    public function actionType()
    {
      $model = new  ArticleType();
       $request = \Yii::$app->request;
        if ($request->isPost) {

            $model->load($request->post());

            if ($model->validate()) {

                $model->save();
                return $this->redirect(['index']);
            }

        }

      return $this->render('type',compact('model'));


    }

    public function actionContentEdit($id)
    {
        $model1 = Article::findOne($id);
        $model1->view_count=$model1->view_count+1;
        $model1->save();
//        var_dump($model1->view_count);exit;
        $model = ArticleContent::findOne($id);


        $request = \Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());
            if ($model->validate()) {
                $model->save();
                return $this->redirect(['index']);
            }

        }

        return $this->render('content',compact('model','model1'));


    }

    public function actionUpload()
    {

//        {"code": 0, "url": "http://domain/图片地址", "attachment": "图片地址"}
//        var_dump($_FILES);exit;
        $file = UploadedFile::getInstanceByName('file');

       //var_dump($file);
        if($file){
            $path = 'images/article/'.time().'.'.$file->extension;
//            var_dump($path);


            if($file->saveAs($path,false)){

                $result = [
                    'code'=>0,
                    'url'=>'/'.$path,
                    'attachment'=>$path,
                ] ;
                //var_dump($result);
           return json_encode($result);

            }
        }

    }
}
