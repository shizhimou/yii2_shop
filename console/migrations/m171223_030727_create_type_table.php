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
        $this->createTable('type', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull()->comment('文章类型'),

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
