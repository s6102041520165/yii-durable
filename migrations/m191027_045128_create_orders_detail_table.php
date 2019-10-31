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
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%orders_detail}}', [
            'id' => $this->primaryKey(),
            'orders_id' => $this->integer()->notNull(),
            'material_id' => $this->integer()->notNull(),
            'amount'=> $this->integer()->notNull(),
            'status' => $this->integer()
        ],$tableOptions);

       
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders_detail}}');
    }
}
