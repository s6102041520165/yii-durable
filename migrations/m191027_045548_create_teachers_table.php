<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%teachers}}`.
 */
class m191027_045548_create_teachers_table extends Migration
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
        $this->createTable('{{%teachers}}', [
            'id' => $this->primaryKey(),
            'prefix_id' => $this->integer()->notNull(),
            'first_name' => $this->string(50)->notNull(),
            'last_name' => $this->string(50)->notNull(),
            'faculty_id' => $this->integer()->notNull(),
            'address' => $this->string(),
            'telephone' => $this->string(11),
            'email' => $this->string(30),
            'user_id' => $this->integer()->notNull()
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%teachers}}');
    }
}
