<?php

namespace backend\controllers;

use backend\models\AuthItem;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\rbac\Role;

class RoleController extends BaseController
{
    public function actionIndex()
    {
        $authManager=\Yii::$app->authManager;
        $model = $authManager->getRoles();
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
        $manage = \Yii::$app->authManager;
        $request = \Yii::$app->request;
        if ($model->load($request->post()) && $model->validate()){
//            echo "<pre>";
//            var_dump($model);exit;
//        var_dump($model->permissions);exit;
            $role = $manage->createRole($model->name);
            $role->description = $model->description;
            if ($manage->add($role)) {
//                var_dump($model->permissions);exit;
                if ($model->permissions) {
                    foreach ($model->permissions as $permission){
                        $manage->addChild($role,$manage->getPermission($permission));

                    }
                }
            }
            \Yii::$app->session->setFlash('info','添加'.$model->description.'权限成功');
//            return $this->redirect(['role/index']);
            return $this->refresh();
        }
//        var_dump($model->getErrors());exit;
         $permissions = $manage->getPermissions();

          $permissions=ArrayHelper::map($permissions,'name','description');
//        echo '<pre>';
//        var_dump($permissions);exit;
        return $this->render('add',compact('model','permissions'));
    }

    public function actionEdit($name)
    {
//        $model = new AuthItem();
        $model = AuthItem::findOne($name);
        $request = \Yii::$app->request;
        $manage = \Yii::$app->authManager;
        $permission = $manage->getPermissionsByRole($name);
//        var_dump(array_keys($permission));exit;
        $model->permissions = array_keys($permission);
        if ($model->load($request->post()) && $model->validate()){
//            echo "<pre>";
//            var_dump($model);exit;

            $role = $manage->getRole($model->name);
//            var_dump($role);exit;
            if ($role){
                $role->description = $model->description;
                if ($manage->update($model->name,$role)) {
//                     var_dump($role);exit;
                    $manage->removeChildren($role);
                    if ($model->permissions) {
                        foreach ($model->permissions as $permission){
                            $manage->addChild($role,$manage->getPermission($permission));

                        }
                    }
                }
                \Yii::$app->session->setFlash('info','修改'.$model->description.'权限成功');
                return $this->redirect(['auth-item/index']);

            }else{
                \Yii::$app->session->setFlash('info','修改'.$model->name.'权限失败');
                return $this->refresh();
//                return $this->redirect(['auth-item/edit']);
            }

        }
        $permissions = $manage->getPermissions();

        $permissions=ArrayHelper::map($permissions,'name','description');
        return $this->render('edit',compact('model','permissions'));
//        var_dump($model->getErrors());exit;
    }

    public function actionDel($name)
    {
        $manage = \Yii::$app->authManager;

        $role = $manage->getRole($name);

        if ($manage->removeChildren($role)&&$manage->remove($role)) {
            \Yii::$app->session->setFlash('info','删除'.$name.'权限成功');
            return $this->redirect(['auth-item/index']);
        }

    }

}
