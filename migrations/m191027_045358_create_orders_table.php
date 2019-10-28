<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m191027_045358_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey()->notNull(),
            'teachers_id' => $this->integer()->notNull(),
            'term' => $this->string(1)->notNull(),
            'year_of_study' => $this->string(4)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'amount_item' => $this->integer()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
