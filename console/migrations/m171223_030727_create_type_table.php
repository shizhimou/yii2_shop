<?php

use yii\db\Migration;

/**
 * Handles the creation of table `type`.
 */
class m171223_030727_create_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_type', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull()->comment('文章类型'),
            'intro' => $this->string()->notNull()->comment('简介'),
            'status' => $this->integer()->notNull()->comment('状态'),
            'sort' => $this->integer()->notNull()->comment('排序'),
            'is_help' => $this->integer()->notNull()->comment('帮助文章'),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('type');
    }
}
