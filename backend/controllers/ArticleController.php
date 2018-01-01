<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleContent;
use backend\models\ArticleType;
use flyok666\qiniu\Qiniu;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class ArticleController extends \yii\web\Controller
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

        $article = Article::find()->orderBy('id');
        $count = $article->count();
        $pagination = new Pagination(
            ['totalCount' => $count, 'pageSize' => 3]

        );
        $articles = $article->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',compact('articles','content','pagination'));
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
//            echo '<pre>';
//var_dump($model->content_id);exit;
            if ($model->validate()) {
//                echo '<pre>';
//var_dump($model);exit;
            }
//                $model->create_time = time();
                if ($model->save()) {
//                    \Yii::$app->session->setFlash('success','添加文章成功');
//                    var_dump($model
//
//->id);exit;
                }

            }

        $content = new ArticleContent();
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $content->load($request->post());
//            echo '<pre>';
//            var_dump($content->content);exit;
            if ($content->validate()) {
                $content->id = $model->id;
//                var_dump($content->content);exit;
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

        $url = \Yii::getAlias('@webroot/').Article::findOne($id)->img;

//            var_dump(111);exit;

        if (Article::findOne($id)->delete()) {
            ArticleContent::findOne($id)->delete();
            if (is_file($url)) {
                unlink($url);
            }
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

    public function actionUploads()
    {

//        {"code": 0, "url": "http://domain/图片地址", "attachment": "图片地址"}
//        var_dump($_FILES);exit;
//        $file = UploadedFile::getInstanceByName('file');
//
//       //var_dump($file);
//        if($file){
//            $path = 'images/article/'.time().'.'.$file->extension;
////            var_dump($path);
//
//
//            if($file->saveAs($path,false)){
//
//                $result = [
//                    'code'=>0,
//                    'url'=>'/'.$path,
//                    'attachment'=>$path,
//                ] ;
//                //var_dump($result);
//           return json_encode($result);
//            }
//        }

        $config = [
            'accessKey' => 'q_rcZdza58NonrULcS_feNKfk893O8lq6oxF1Omv',//AK
            'secretKey' => 'I7ztXLwTOSTOcWY8svGLxhFZzsVcEiXiHvjZP9ed',//SK
            'domain' => 'http://p1jrt03ee.bkt.clouddn.com',//临时域名
            'bucket' => 'yii2',//空间名称
            'area' => Qiniu::AREA_HUADONG//区域
        ];
//
////var_dump($_FILES);exit;
//
//
        $qiniu = new Qiniu($config);//实例化对象
//var_dump($qiniu);exit;
        $key = time();//上传后的文件名
//        var_dump($_FILES);exit;
        $qiniu->uploadFile($_FILES['file']["tmp_name"], $key);//调用上传方法上传文件
        $url = $qiniu->getLink($key);//得到上传后的地址
//
        //返回的结果
        $result = [
            'code' => 0,
            'url' => $url,
            'attachment' => $url

        ];
        return json_encode($result);
    }
}
