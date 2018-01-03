<?php

namespace backend\controllers;

use backend\models\ArticleType;

class ArticleTypeController extends BaseController
{
    public function actionIndex()
    {
        $model = ArticleType::find()->all();


        var_dump($model->article->type);exit;

        return $this->render('index',compact('model'));
    }

}
