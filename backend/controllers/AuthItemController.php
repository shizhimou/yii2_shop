<?php

namespace backend\controllers;

use backend\models\AuthItem;
use yii\data\Pagination;

class AuthItemController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        $model = AuthItem::find();
        $authManager=\Yii::$app->authManager;
        $model = $authManager->getPermissions();

//        $count = $model['name']->count();
//        $pagination = new Pagination(
//            ['totalCount' => $count, 'pageSize' => 5]
//        );
//        $model = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index',compact('model'));
    }

    public function actionAdd()
    {
        $model = new AuthItem();

        $request = \Yii::$app->request;

        if ($model->load($request->post()) && $model->validate()){
//            echo "<pre>";
//            var_dump($model);exit;

            $manage = \Yii::$app->authManager;

            $premission = $manage->createPermission($model->name);
            $premission->description = $model->description;
            $manage->add($premission);
            \Yii::$app->session->setFlash('info','添加'.$model->description.'权限成功');
            return $this->redirect(['auth-item/index']);
        }
//        var_dump($model->getErrors());exit;

        return $this->render('add',compact('model'));
    }

    public function actionEdit($name)
    {
//        $model = new AuthItem();
        $model = AuthItem::findOne($name);
        $request = \Yii::$app->request;

        if ($model->load($request->post()) && $model->validate()){
//            echo "<pre>";
//            var_dump($model);exit;
            $manage = \Yii::$app->authManager;
            $premission = $manage->getPermission($model->name);
            if ($premission){
                $premission->description = $model->description;
                $manage->update($model->name,$premission);
                \Yii::$app->session->setFlash('info','修改'.$model->description.'权限成功');
                return $this->redirect(['auth-item/index']);

            }else{
                \Yii::$app->session->setFlash('info','修改'.$model->name.'权限失败');
                return $this->refresh();
//                return $this->redirect(['auth-item/edit']);
            }

        }
        return $this->render('add',compact('model'));
//        var_dump($model->getErrors());exit;
    }

    public function actionDel($name)
    {
        $manage = \Yii::$app->authManager;

        $premission = $manage->getPermission($name);

        if ($manage->remove($premission)) {
            \Yii::$app->session->setFlash('info','删除'.$name.'权限成功');
            return $this->redirect(['auth-item/index']);
        }

    }

}
