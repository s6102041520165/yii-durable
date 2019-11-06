<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%withdraw}}`.
 */
class m191031_142714_create_withdraw_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%withdraw}}', [
            'id' => $this->primaryKey(),
            'material_id' => $this->integer()->notNull(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'items'=> $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%withdraw}}');
    }
}
