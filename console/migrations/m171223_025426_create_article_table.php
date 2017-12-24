<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m171223_025426_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'author'=>$this->string(30)->notNull()->comment('作者'),
            'title'=>$this->string(100)->notNull()->comment('标题'),

            'sort'=>$this->smallInteger()->notNull()->comment('排名'),
            'status'=>$this->smallInteger()->notNull()->comment('状态'),
            'create_time'=>$this->integer()->notNull()->comment('发布时间'),
            'img'=>$this->string()->notNull()->comment('文章LOGO'),
            'view_count'=>$this->integer()->notNull()->comment('浏览次数'),
            'type_id'=>$this->integer()->notNull()->comment('类型编号'),
            'content_id'=>$this->integer()->notNull()->comment('内容编号'),



        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
