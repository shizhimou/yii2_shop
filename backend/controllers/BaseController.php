<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/3
 * Time: 16:01
 */

namespace backend\controllers;


use backend\filters\RbacFilter;
use yii\web\Controller;

class BaseController extends Controller
{

    public function behaviors()
    {
       return [
            'rbac' => [
                'class' => RbacFilter::className(),
            ],
        ];
    }

}