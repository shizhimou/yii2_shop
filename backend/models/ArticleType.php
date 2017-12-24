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
            [['type'], 'required'],
            [['type'], 'string', 'max' => 255],
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
        ];
    }

    public function getArticle()
    {
        return $this->hasMany(Article::className(),['type_id'=>'id']);
    }
}
