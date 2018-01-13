<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sn
 * @property string $logo
 * @property integer $goods_category_id
 * @property integer $brand_id
 * @property integer $market_price
 * @property integer $shop_price
 * @property integer $stock
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imgFiles;
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name',  'goods_category_id', 'brand_id', 'market_price', 'shop_price', 'status', 'sort'], 'required'],
            [['name', 'logo', 'create_time', 'stock','imgFiles'], 'safe' ],
            [['sn'],'unique']
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
            'sn' => '货号',
            'logo' => 'logo',
            'goods_category_id' => '商品分类',
            'brand_id' => '品牌分类',
            'market_price' => '市场价',
            'shop_price' => '本店价',
            'stock' => '库存',
            'status' => '状态',
            'sort' => '排序',
            'create_time' => '上架时间',
        ];
    }

    public function getGoods()
    {
        return $this->hasOne(GoodsCategory::className(),['id'=>'goods_category_id']);
    }
    public function getBrand()
    {
        return $this->hasOne(Brand::className(),['id'=>'brand_id']);
    }
    public function getGallery()
    {
        return $this->hasMany(GoodsGallery::className(),['goods_id'=>'id']);
    }
    public function getIntro()
    {
        return $this->hasOne(GoodsIntro::className(),['goods_id'=>'id']);
    }
}
