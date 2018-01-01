# 一、商品品牌
##需求
```$xslt
1.品牌管理功能涉及品牌的列表展示、品牌添加、修改、删除功能。

2.品牌需要保存缩略图和简介。

3.品牌删除使用逻辑删除。 
```
```php
1.要点难点及解决方案
1.1实现软删除
解决方案
①添加回收站按钮 用来改变品牌状态 需要写方法来改变
②改变品牌的状态 status 
③再显示商品
④用到了两个显示方法 用来切换上架和下架的两个页面

1.2删除临时文件
解决方案
①找到临时文件的位置 拼装路径
②语法 unlike（路径）
③删除数据库数据
④判定临时文件是否存在
⑤删除临时文件
```
# 二、商品文章
```php
1.要点难点及解决方案
1.1创建普通显示表和内容表
原因：提高了查询速度 减少了数据库的压力 也便于自己管理
1.2实现连表显示
hasOne 一对一
hasMany 一对多
用哪个对应就在哪个的models中写一下这个方法
<?php
public function getType()
    {
        return $this->hasOne(ArticleType::className(),['id'=>'type_id']);
    }
?>
1.3.1实现webuploader的图片上传方式
通过composer下载
地址：https://packagist.org/packages/bailangzhan/yii2-webuploader
运行下面代码
composer require bailangzhan/yii2-webuploader
修改params.php中配置
通过查看以下网址，进行修改和配置
http://www.yiichina.com/extension/1336
1.3.2文件上传到七牛云上

github上搜索 yii2 qiniu
composer require flyok666/yii2-qiniu


composer.json:

{
  "require": {
    "flyok666/yii2-qiniu": "~1.0.0"
  }
}
Usage

<?php

use flyok666\qiniu\Qiniu;
$config = [
'accessKey'=>'xxx',
'secretKey'=>'xxx',
'domain'=>'http://demo.domain.com/',
'bucket'=>'demo',
'area'=>Qiniu::AREA_HUABEI
];



$qiniu = new Qiniu($config);
$key = time();
$qiniu->uploadFile($_FILES['tmp_name'],$key);
$url = $qiniu->getLink($key);
```
```php
1.4实现富文本框编辑内容
GitHub上搜索 yii2 udeitor 使用大裤衩叔叔的

安装

Either run

$ php composer.phar require kucha/ueditor "*"
or add

"kucha/ueditor": "*"
to the require section of your composer.json file.

应用

controller:

public function actions()
{
    return [
        'upload' => [
            'class' => 'kucha\ueditor\UEditorAction',
        ]
    ];
}
view:

echo \kucha\ueditor\UEditor::widget(['name' => 'xxxx']);
或者：

echo $form->field($model,'colum')->widget('kucha\ueditor\UEditor',[]);

1.5使用多模型实现文章和内容的同步提交解决用户体验
```
# 三、商品分类
```php
1.1需求
①完成增删改查
②分类无限级
GitHub中搜索 yii2 nested
完成配置 根据文档进行配置 实现其功能
③分类列表要有层次结构
github中搜索 yii2 ztree
④显示无限极列表
搜索 yii2-treegrid 

view中
<?= \liyuze\ztree\ZTree::widget([
        'setting' => '{
			data: {
				simpleData: {
					enable: true,
					pIdKey: "parent_id",
				}
			},
			callback: {
				onClick: function(e,treeId, treeNode){
				$("#goodscategory-parent_id").val(treeNode.id);
				},
			}
			
			
			
		}',
        'nodes' => $good,
    ]);
    ?>       
  //展开分类  
 <?php
 $js=<<<EOC
 var treeObj = $.fn.zTree.getZTreeObj("w1");
 treeObj.expandAll(true);
EOC;
 $this->registerJs($js);
 ?>   

网站 www.treejs.cn 


```
# 四、商品管理
```php
1.1需求完成增删改查

1.2流程
①建立商品表 goods
②在视图中用droplist获取另外一张表的值
$type = GoodsCategory::find()->asArray()->all();
$types = ArrayHelper::map($type,'id','name');
③利用hason连接表获取值get方法牛逼

1.3要点与难点分析
①自动生成货单号
对数据库的货号进行判定 进行了强制转换实现起功能
②实现多图片上传 并且回显
http://www.cnblogs.com/tengjian/p/7240976.html
③实现搜索关键字
通过\Yii::$app->request->get（）方法，获取地址参数的值 并用andwhere进行判定 andwhere只在yii2中实现其不覆盖的功能。实现状态的搜索 把status 结合in_array 当做数组判定；如果用if则需要用到全等 并且是字符串，因为get接受为字符串。
④后台模板
dmstr/yii2-adminlte-asset
复制核心文件vendor中的视图，进行修改
a.修改模板
对模版进行简单的显示连接
⑤使用一下代码，实现提示语的自动消失
<?php
$JS=<<<JS

  $(function() {
    $('#w0-info').fadeOut(3000);
  });
JS;

$this->registerJs($JS);

?>
```
# 五、管理员登录
```php
1.1需求 完成简单的增删改查
分两个步骤：
①注册：需要进行增删改查 用数据模型
对账号进行判定是否重复，进行提示
对密码进行哈希加密 防止被盗
$admin->password = \Yii::$app->security->generatePasswordHash($admin->password);
②登录：只进行登录验证 创建表单模型
注意：注册需要接口，创建一个对象放到user类中，通过获取身份得到该对象
在控制器中 ①进行表单注册验证 ②做rbac需要进行添加角色
在模型中 ①通过身份找到当前对象 ②通过当前ID找到身份
③登录令牌 通过getAuthKey() 返回字段属性
④在通过validdateAuthKey($AuthKey) ,进行验证 实现自动登录 
控制器中获取令牌
$num->token = \Yii::$app->security->generateRandomString();
⑤对密码进行加严加密，用到hash密码 并进行验证
 $result=\Yii::$app->security->validatePassword($model->password,$num->password);
注意：获取最后登录时间和最后登陆IP，相当于修改，所以其他属性要进行验证，我的处理方式为把rules 全部改为safe;
⑥登录保存密码 通过记住我 rememberMe属性 进行判定，只需在自动登录中使用第二个参数 判定rememberMe是否存在 存在是设置过期时间，记录了cookie 否则为0；
⑦登录拔取了site中的登录页面

⑧管理员登录配置：在后台config中；
'user' => [
                    'identityClass' => \backend\models\Admin::className(),
                    'enableAutoLogin' => true,
                    'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
                ],
⑨登录流程
判定账号是否存在，再判定密码是否正确                 
⑩退出登录
执行这句代码 ：\Yii::$app->user->logout()；
11.验证码
①在登录表单模型中添加code规则，属性和lable;
 [['code'],'captcha','captchaAction' => 'admin/captcha'],
②在控制器中把写入数据库改为false，因为验证码只能验证一次；可以不用save()方法，因为login()方法已经有保存到数据库的功能了；
写一个actions方法 验证码自动调用以下方法
public function actions()
    {
        return [
            'captcha'=> [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'maxLength' => 4,
                'minLength' => 3,
            ]
        ];

    }
③视图中
\yii\captcha\Captcha::widget（）；
表示使用自己的验证码。要和模型中对应起来；
'captchaAction' =>'admin/captcha',//指定操作
④公共文件main中有一个cache组件 实现了验证码功能。
            
```
# 六、RBAC权限管理
### 1.1需求 完成权限表的增删改查
```php

①配置文件在公共配置文件，组件中进行设置

'authManager'=>[

            'class'=>'yii\rbac\DbManager',
        ]
②生成权限模型
注释对应关系方法；
③生成权限控制器
一、完成权限的增加
a.常规验证表单
b.验证完成，
1.实例化权限组件 ；
$manage = \Yii::$app->authManager;
2.通过组件对象创建权限 ，其中是根据实例化的对象 name主键 得到的；
$premission = $manage->createPermission($model->name);
3.得到$premission；再把其他表单属性添加到其中
$premission->description = $model->description;
4.通过组件对象把权限添加权限到数据库中
$manage->add($premission);
二、完成权限的显示
1.实例化组件对象；
$authManager=\Yii::$app->authManager;
2.通过组件对象得到所有的权限；       
$model = $authManager->getPermissions();  
3.常规的把数据传到index中；  
三、完成权限的修改
a.和添加一样完成常规的表单验证
注意：修改是传入的$name主键；
1.实例化权限组件对象 通过得到权限进行判定，这里都是通过表单中传过来的name主键查找的，如果判定存在可以进行修改；
2.name主键是不能修改的。
3.使用update方法进行修改
$manage->update($model->name,$premission);
四、完成权限的删除
1.实例化权限组件对象
通过name找到权限，再通过以下代码完成删除；
$manage->remove($premission)
视图中
通过strpos()；字符串内置方法判定是否存在 / ，来进行层级显示；

```
### 1.2需求 完成角色表的增删改查
```php
一、完成角色的添加
注意：
get:
①这里由于给一个角色添加多个权限的时候所以把实例化权限组件对象放在了post外面，因为这里要用get得到所有权限，再分配到添加是图中，视图中使用checkboxList就可以了；
②由于权限很多，所以在模型中添加了一个存储数组的变量；
获取所有的权限，通过map方法传入的添加视图中
ArrayHelper::map()；
post:
常规的完成表单验证
2.通过组件创建角色
createRole();
再把描述添加到角色中；
3.用add()方法把角色添加到数据库中；
4.因为角色的权限是很多的，所以首先要判定表单传过来的权限是否存在；
  再循环遍历权限；
5.通过addChild()方法把权限存入到角色中；
  $manage->addChild($role,$manage->getPermission($permission));
二、完成角色的显示
1.实例化组件对象 
2.得到所有的角色 getRoles()
3.常规的传入到现实视图中
三、完成角色的修改
1.和添加一样也是先完成常规的表单验证
2.因为要回显复选框的权限，所以要用
$manage = \Yii::$app->authManager;
通过得到角色得到权限 ，因为打印出来权限是一个对象 但是他的键就是权限
所以用到array_keys();获取到所有的键；
再把他复制给permissions属性；就回显出来了；
$permission = $manage->getPermissionsByRole($name);
//var_dump(array_keys($permission));exit;
$model->permissions = array_keys($permission);
3.通过getRole()找到当前角色
a.判定对象是否存在，再把描述给角色；
b.把修改的数据保存到数据库中 通过update()方法
$manage->update($model->name,$role)
c.删除角色中的所有权限
$manage->removeChildren($role);
d.判定表单中是否传过来权限，如果有
循环权限 保存到角色中
$manage->addChild($role,$manage->getPermission($permission));
四、完成角色的删除
1.实例化权限组件
2.得到角色
3.删除角色中的权限再删除角色；
$manage->removeChildren($role)&&$manage->remove($role)；

```
### 1.3需求 用户添加到角色中

```php
1.在admin控制器中

add方法：
//得到权限对象
$auth = \Yii::$app->authManager;
//通过权限对象得到角色
$role = $auth->getRole($admin->role);
//把用户分配到角色中
$auth->assign($role,$admin->id);
2.在admin模型中设置role规则，role属性；
3.在视图中添加role属性文本框；
```



















