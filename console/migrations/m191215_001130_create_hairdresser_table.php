<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hairdresser}}`.
 */
class m191215_001130_create_hairdresser_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hairdresser}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'photo' => $this->string()->defaultValue(Null),
            'status' => $this->tinyInteger(2)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hairdresser}}');
    }
}
