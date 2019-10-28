<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%prefix}}`.
 */
class m191027_045251_create_prefix_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%prefix}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(15)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%prefix}}');
    }
}
