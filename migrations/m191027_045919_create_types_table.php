<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%types}}`.
 */
class m191027_045919_create_types_table extends Migration
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
        $this->createTable('{{%types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ],$tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%types}}');
    }
}
