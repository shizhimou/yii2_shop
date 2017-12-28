<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m171228_033806_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(100)->notNull()->comment('名称'),
            'sn'=>$this->integer()->notNull()->comment('货号'),
            'logo'=>$this->string(100)->notNull()->comment('logo'),
            'goods_category_id'=>$this->integer()->notNull()->comment('商品分类'),
            'brand_id'=>$this->integer()->notNull()->comment('品牌分类'),
            'market_price'=>$this->decimal()->notNull()->comment('市场价'),
            'shop_price'=>$this->decimal()->notNull()->comment('本店价'),
            'stock'=>$this->integer()->notNull()->comment('库存'),
            'status'=>$this->integer()->notNull()->comment('状态'),
            'sort'=>$this->integer()->notNull()->comment('排序'),
            'create_time'=>$this->integer()->notNull()->comment('上架时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}
