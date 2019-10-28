<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders_detail}}`.
 */
class m191027_045128_create_orders_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders_detail}}', [
            'id' => $this->primaryKey(),
            'orders_id' => $this->integer()->notNull(),
            'material_id' => $this->integer()->notNull(),
            'amount'=> $this->integer()->notNull(),
            'status' => $this->integer()
        ]);

       
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders_detail}}');
    }
}
