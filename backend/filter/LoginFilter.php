<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/1
 * Time: 11:07
 */

namespace backend\filter;


use backend\models\Admin;
use yii\base\ActionFilter;

class loginFilter extends ActionFilter
{

    public function beforeAction($action)
    {
        $login = new Admin();
        $login->last_login_ip = \Yii::$app->request->userIP;
        $login->last_login_time = time();
        $login->save();
        return parent::beforeAction($action);

    }
}