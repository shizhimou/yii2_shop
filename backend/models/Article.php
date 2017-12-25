<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $author
 * @property string $title
 * @property integer $sort
 * @property integer $status
 * @property integer $create_time
 * @property string $img
 * @property integer $view_count
 * @property integer $type_id
 * @property integer $content_id
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
//    public $imgFile;
    public static function tableName()
    {
        return 'article';
    }

    public function behaviors()
    {

        return [
          [
              'class'=>TimestampBehavior::className(),
              'attributes' => [
                  ActiveRecord::EVENT_BEFORE_INSERT=>'create_time']
          ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author', 'title', 'status', 'sort','create_time', 'view_count', 'type_id', 'content_id'], 'required'],
            [['sort', 'status', 'create_time', 'view_count', 'type_id', 'content_id'], 'integer'],
            [['author'], 'string', 'max' => 30],
            [['title'], 'string', 'max' => 100],
            [['img'], 'safe'],
            [['sort'],'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => '作者',
            'title' => '标题',
            'sort' => '排名',
            'status' => '状态',
            'create_time' => '发布时间',
            'img' => '文章LOGO',
            'view_count' => '浏览次数',
            'type_id' => '类型编号',
            'content_id' => '内容',

        ];
    }

    public function getTime()
    {
        return date('Y-m-d H:i:s',$this->create_time);
    }
    public function getType()
    {

        return $this->hasOne(ArticleType::className(),['id'=>'type_id']);

    }

    public function getContent()
    {

        return $this->hasOne(ArticleContent::className(),['id'=>'id']);

    }
}
