<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%units}}`.
 */
class m191027_044743_create_units_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%units}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%units}}');
    }
}
