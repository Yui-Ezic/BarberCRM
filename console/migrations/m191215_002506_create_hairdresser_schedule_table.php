<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hairdresser_schedule}}`.
 */
class m191215_002506_create_hairdresser_schedule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hairdresser_schedule}}', [
            'id' => $this->primaryKey(),
            'hairdresser_id' => $this->integer(),
            'date' => $this->date(),
            'from_time' => $this->string(5)->comment("time in the format H:MM (ex. 8:30)"),
            'to_time' => $this->string(5)->comment("time in the format H:MM (ex. 19:30)"),
        ]);

        // Create foreign key to hairdresser table
        $this->addForeignKey("fk-hairdresser_schedule-hairdresser_id",
            'hairdresser_schedule', 'hairdresser_id',
            'hairdresser', 'id',
            "RESTRICT", "RESTRICT");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hairdresser_schedule}}');
    }
}
