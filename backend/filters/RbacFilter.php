<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/1
 * Time: 11:07
 */

namespace backend\filters;


use backend\models\Admin;
use yii\base\ActionFilter;
use yii\db\Exception;
use yii\web\HttpException;

class RbacFilter extends ActionFilter
{

    public function beforeAction($action)
    {
//        if (!\Yii::$app->user->can($action->uniqueId)) {
////         return \Yii::$app->session->setFlash('info','你没有访问权限');
//
////            return false;
////            throw new HttpException(403,'你没有访问权限');
////            return false;
//            $html=<<<HTML
//             <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
//<html xmlns="http://www.w3.org/1999/xhtml">
//<head>
//<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
//<title>跳转提示</title>
//<style type="text/css">
//*{ padding: 0; margin: 0; }
//body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
//.system-message{ padding: 24px 48px; }
//.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
//.system-message .jump{ padding-top: 10px}
//.system-message .jump a{ color: #333;}
//.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
//.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
//</style>
//</head>
//<body>
//<div class="system-message">
//<h1>:(</h1>
//<p class="error">没有权限</p><p class="detail"></p>
//<p class="jump">
//页面自动 <a id="href" href="javascript:history.back(-1);">跳转</a> 等待时间： <b id="wait">3</b>
//</p>
//<!--&lt;!&ndash;[ <a href="http://www.thinkphp.cn/">返回首页</a> ]-->
//
//</div>
//<script type="text/javascript">
//(function(){
//var wait = document.getElementById('wait'),href = document.getElementById('href').href;
//var interval = setInterval(function(){
//	var time = --wait.innerHTML;
//	if(time == 0) {
//		location.href = href;
//		clearInterval(interval);
//	};
//}, 1000);
//})();
//</script>
//</body>
//</html>
//HTML;
//
//                echo $html;
//
//            return false;
//        }
            return parent::beforeAction($action);


    }
}