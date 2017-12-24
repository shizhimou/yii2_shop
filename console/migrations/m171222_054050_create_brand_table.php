<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m171222_054050_create_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->notNull()->comment('名称'),
            'logo'=>$this->string(100)->notNull()->comment('Logo'),
            'intro'=>$this->text()->comment('简介'),
            'status'=>$this->smallInteger()->comment('状态'),
            'sort'=>$this->smallInteger()->notNull()->defaultValue(100)->comment('排序'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('brand');
    }
}
