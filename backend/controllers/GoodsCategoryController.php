<?php

namespace backend\controllers;

use backend\models\Goods;
use backend\models\GoodsCategory;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\Exception;
use yii\helpers\Json;

class GoodsCategoryController extends BaseController
{
    public function actionIndex()
    {

        $models= GoodsCategory::find()->orderBy('tree,lft');
        $query = GoodsCategory::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $count = $models->count();
        $pagination = new Pagination(
            ['totalCount' => $count, 'pageSize' => 5]

        );
        $models = $models->offset($pagination->offset)->limit($pagination->limit)->all();

//            var_dump($goods);exit;

        return $this->render('index',compact('models','pagination','dataProvider'));

    }

    public function actionAdd()
    {

       $good =  GoodsCategory::find()->asArray()->all();

//       $good[] =
       $good = Json::encode($good);
//       var_dump($good);exit;

        $model = new GoodsCategory();

        $request= \Yii::$app->request;

        if ($request->isPost) {

            $model->load($request->post());

            if ($model->validate()) {

                if($model->parent_id==0){
                   \Yii::$app->session->setFlash('info','添加'.$model->name.'父节点成功');
                    $model->makeRoot();

                }else{

                    $cate = GoodsCategory::findOne($model->parent_id);
                    \Yii::$app->session->setFlash('info','把'.$model->name.'添加到'.$cate->name.'中成功');
                    $model->prependTo($cate);
                }
                    return $this->redirect('index');

            }
            return $this->refresh();
        }


        return $this->render('add', ['model' => $model,'good'=>$good]);

    }

    public function actionUpdate($id)
    {

        $good =  GoodsCategory::find()->asArray()->all();

//       $good[] =
        $good = Json::encode($good);
//       var_dump($good);exit;

        $model = GoodsCategory::findOne($id);

        $request= \Yii::$app->request;

        if ($request->isPost) {

            $model->load($request->post());

            if ($model->validate()) {

                try{

                    if ($model->parent_id == 0) {
                        $cate = GoodsCategory::findOne($model->parent_id);
                        \Yii::$app->session->setFlash('info', '修改' . $model->name . '父节点成功');
//                    echo '<pre>';
//                    var_dump($model);exit;
                        $model->save();

                    } else {

                        $cate = GoodsCategory::findOne($model->parent_id);
                        $model->prependTo($cate);
                        \Yii::$app->session->setFlash('info', '把' . $model->name . '添加到' . $cate->name . '中成功');
//                  echo '<pre>';
//                    var_dump($model);exit;

                    }
                }catch (Exception $exception){
                  \Yii::$app->session->setFlash('info',$exception->getMessage());

                  return $this->refresh();
                }


                return $this->redirect('index');
            }

            return $this->refresh();
        }
        return $this->render('add', ['model' => $model,'good'=>$good]);

    }

    public function actionDelete($id)
    {

        $goods = Goods::find()->where(['goods_category_id'=>$id])->one();
        $cate = GoodsCategory::findOne($id);
//        var_dump($goods->goods_category_id);exit;
        if ($goods===null || $goods->goods_category_id===$cate->id ){
            \Yii::$app->session->setFlash('info','删除商品分类的时候，请先删除对应的商品，否则商品不能显示！！！');
            return $this->redirect(['goods-category/index']);
        }else{

            if (GoodsCategory::findOne($id)->deleteWithChildren()) {
                return $this->redirect('index');
            }
        }


    }

    public function actionView($id)
    {

        $good =  GoodsCategory::find()->asArray()->all();

//       $good[] =
        $good = Json::encode($good);
//       var_dump($good);exit;

        $model = GoodsCategory::findOne($id);

        $request= \Yii::$app->request;

        if ($request->isPost) {

            $model->load($request->post());

            if ($model->validate()) {

                try{

                    if ($model->parent_id == 0) {
                        $cate = GoodsCategory::findOne($model->parent_id);
                        \Yii::$app->session->setFlash('info', '修改' . $model->name . '父节点成功');
//                    echo '<pre>';
//                    var_dump($model);exit;
                        $model->save();

                    } else {

                        $cate = GoodsCategory::findOne($model->parent_id);
                        $model->prependTo($cate);
                        \Yii::$app->session->setFlash('info', '把' . $model->name . '添加到' . $cate->name . '中成功');
//                  echo '<pre>';
//                    var_dump($model);exit;

                    }
                }catch (Exception $exception){
                    \Yii::$app->session->setFlash('info',$exception->getMessage());

                    return $this->refresh();
                }


                return $this->redirect('index');
            }

            return $this->refresh();
        }
        return $this->render('view', ['model' => $model,'good'=>$good]);

    }
}
