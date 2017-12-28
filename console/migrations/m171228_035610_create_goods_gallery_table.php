<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_gallery`.
 */
class m171228_035610_create_goods_gallery_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_gallery', [
            'id' => $this->primaryKey(),
            'goods_id'=>$this->integer()->comment('商品编号'),
            'path'=>$this->integer()->comment('存储路径'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_gallery');
    }
}
