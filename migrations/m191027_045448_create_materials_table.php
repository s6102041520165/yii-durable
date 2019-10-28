<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%materials}}`.
 */
class m191027_045448_create_materials_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%materials}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'types_id' => $this->integer()->notNull(),
            'brand_id' => $this->integer()->notNull(),
            'details' => $this->string(),
            'units_id' => $this->integer()->notNull(),
            'price' => $this->double()->notNull()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%materials}}');
    }
}
