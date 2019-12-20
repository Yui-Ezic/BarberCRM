<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%appointment}}`.
 */
class m191215_003950_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer(),
            'service_id' => $this->integer(),
            'hairdresser_id' => $this->integer(),
            'date' => $this->date(),
            'start_time' => $this->string(5)->comment("time in the format H:MM (ex. 14:30)"),
            'duration' => $this->integer()->defaultValue(Null),
            'paid' => $this->integer(10)->defaultValue(Null)->comment("How much client is paid for service in UAH"),
            'client_comment' => $this->text()->defaultValue(Null),
            'hairdresser_comment' => $this->text()->defaultValue(Null),
            'status' => $this->tinyInteger()->notNull()->defaultValue(0)
        ]);

        // Create foreign key to hairdresser table
        $this->addForeignKey("fk-order-hairdresser_id",
            'order', 'hairdresser_id',
            'hairdresser', 'id',
            "RESTRICT", "RESTRICT");

        // Create foreign key to service table
        $this->addForeignKey("fk-order-service_id",
            'order', 'service_id',
            'service', 'id',
            "RESTRICT", "RESTRICT");

        // Create foreign key to client table
        $this->addForeignKey("fk-order-client_id",
            'order', 'client_id',
            'client', 'id',
            "RESTRICT", "RESTRICT");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
