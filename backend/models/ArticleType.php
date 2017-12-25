<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article_type".
 *
 * @property integer $id
 * @property string $type
 */
class ArticleType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type','status','sort','is_help'], 'required'],
            [['type'], 'string', 'max' => 255],
            [['intro'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '文章类型',
            'intro' => '类型简介',
            'status' => '类型状态',
            'sort' => '类型排序',
            'is_help' => '类型帮助',
        ];
    }

    public function getArticle()
    {
        return $this->hasMany(Article::className(),['type_id'=>'id']);
    }
}
