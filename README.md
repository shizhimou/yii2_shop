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


















