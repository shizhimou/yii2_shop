<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_content`.
 */
class m171223_031546_create_article_content_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_content', [
            'id' => $this->primaryKey(),
            'content' => $this->text()->notNull()->comment('内容'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_content');
    }
}
