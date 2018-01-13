<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $sn
 * @property integer $create_time
 * @property string $province_name
 * @property string $city_name
 * @property string $area_name
 * @property string $tel
 * @property string $detail_address
 * @property string $delivery_price
 * @property string $pay_type_name
 * @property string $price
 * @property integer $status
 * @property string $delivery_name
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
//    public function rules()
//    {
//        return [
//            [['user_id', 'create_time', 'status'], 'integer'],
//            [['delivery_price', 'price'], 'number'],
//            [['sn', 'province_name', 'city_name', 'area_name', 'detail_address', 'pay_type_name', 'delivery_name'], 'string', 'max' => 255],
//            [['tel'], 'string', 'max' => 20],
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户id',
            'sn' => '订单号',
            'create_time' => '创建时间',
            'province_name' => '省 名',
            'city_name' => '市 名',
            'area_name' => '区 名',
            'tel' => '订单号',
            'detail_address' => '详细 地址',
            'delivery_price' => '运 费',
            'pay_type_name' => '支付 方式',
            'price' => '总 额',
            'status' => '1=未支付 0=支付 ',
            'delivery_name' => 'Delivery Name',
        ];
    }
}
