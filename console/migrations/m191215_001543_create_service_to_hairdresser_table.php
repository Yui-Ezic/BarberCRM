<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service_to_hairdresser}}`.
 */
class m191215_001543_create_service_to_hairdresser_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service_to_hairdresser}}', [
            'id' => $this->primaryKey(),
            'hairdresser_id' => $this->integer(),
            'service_id' => $this->integer(),
            'duration' => $this->tinyInteger(5)->comment("Duration in minutes"),
            'price' => $this->integer(10)->comment("Price in UAH"),
        ]);

        // Create foreign key to hairdresser table
        $this->addForeignKey("fk-service_to_hairdresser-hairdresser_id",
            'service_to_hairdresser', 'hairdresser_id',
            'hairdresser', 'id',
            "RESTRICT", "RESTRICT");

        // Create foreign key to service table
        $this->addForeignKey("fk-service_to_hairdresser-service_id",
            'service_to_hairdresser', 'service_id',
            'service', 'id',
            "RESTRICT", "RESTRICT");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%service_to_hairdresser}}');
    }
}
