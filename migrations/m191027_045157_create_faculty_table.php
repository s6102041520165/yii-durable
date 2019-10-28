<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%faculty}}`.
 */
class m191027_045157_create_faculty_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%faculty}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text(50)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%faculty}}');
    }
}
