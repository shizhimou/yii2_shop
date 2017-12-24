<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 */
class Brand extends \yii\db\ActiveRecord
{

    public $logoFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sort','status'], 'required'],
            [['intro'], 'safe'],
            [['logoFile'],'image','extensions' => 'jpg,png,gif','skipOnEmpty' => false]

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'logo' => 'Logo',
            'intro' => '简介',
            'status' => '状态',
            'sort' => '排序',
            'logoFile' => '标志',
        ];
    }
}
