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
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%materials}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'types_id' => $this->integer()->notNull(),
            'brand_id' => $this->integer()->notNull(),
            'details' => $this->string(),
            'stock' => $this->smallInteger()->notNull(),
            'units_id' => $this->integer()->notNull(),
            'price' => $this->double()->notNull()
        ],$tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%materials}}');
    }
}
