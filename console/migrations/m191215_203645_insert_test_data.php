<?php

use yii\db\Migration;

/**
 * Class m191215_203645_insert_test_data
 */
class m191215_203645_insert_test_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * Hairdresser table
         */
        $this->insert("hairdresser", [
            'id' => 1,
            'first_name' => 'Светлана',
            'last_name' => 'Кузнецова',
            'description' => 'Эксперт по стрижке женщин'
        ]);

        $this->insert("hairdresser", [
            'id' => 2,
            'first_name' => 'Василий ',
            'last_name' => 'Цветков',
            'description' => 'Эксперт по стрижке мужчин'
        ]);

        $this->insert("hairdresser", [
            'id' => 3,
            'first_name' => 'Глеб',
            'last_name' => 'Карпов',
            'description' => 'Уволен',
            'status' => 1
        ]);

        /**
         * Client table
         */
        $this->insert("client", [
            'id' => 1,
            'first_name' => 'Ростислав',
            'last_name' => 'Молчанов',
            'phone_number' => 380934567534,
        ]);

        $this->insert("client", [
            'id' => 2,
            'first_name' => 'Ника',
            'last_name' => 'Степанова ',
        ]);

        /**
         * Hairdresser Schedule table
         */
        $this->insert("hairdresser_schedule", [
            'id' => 1,
            'hairdresser_id' => 1,
            'date' => '2019-12-20',
            'from_time' => '8:30',
            'to_time' => '14:00',
        ]);

        $this->insert("hairdresser_schedule", [
            'id' => 2,
            'hairdresser_id' => 2,
            'date' => '2019-12-20',
            'from_time' => '12:30',
            'to_time' => '19:00',
        ]);

        /**
         * Service table
         */
        $this->insert("service", [
            'id' => 1,
            'name' => 'Простая стрижка',
            'description' => "Simple and chip haircut"
        ]);

        $this->insert("service", [
            'id' => 2,
            'name' => 'Сложная стрижка',
            'description' => "Difficult and expensive haircut"
        ]);

        /**
         * Service to hairdresser table
         */
        $this->insert("service_to_hairdresser", [
            'id' => 1,
            'hairdresser_id' => 1,
            'service_id' => 1,
            'duration' => 60,
            'price' => 80,
        ]);

        $this->insert("service_to_hairdresser", [
            'id' => 2,
            'hairdresser_id' => 2,
            'service_id' => 1,
            'duration' => 30,
            'price' => 40,
        ]);

        $this->insert("service_to_hairdresser", [
            'id' => 3,
            'hairdresser_id' => 2,
            'service_id' => 2,
            'duration' => 60,
            'price' => 160,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /**
         * Service to hairdresser table
         */
        $this->delete("service_to_hairdresser", ['id' => 1]);
        $this->delete("service_to_hairdresser", ['id' => 2]);
        $this->delete("service_to_hairdresser", ['id' => 3]);
        /**
         * Service table
         */
        $this->delete("service", ['id' => 1]);
        $this->delete("service", ['id' => 2]);
        /**
         * Hairdresser Schedule table
         */
        $this->delete("hairdresser_schedule", ['id' => 1]);
        $this->delete("hairdresser_schedule", ['id' => 2]);
        /**
         * Client table
         */
        $this->delete("client", ['id' => 1]);
        $this->delete("client", ['id' => 2]);
        /**
         * Hairdresser table
         */
        $this->delete("hairdresser", ['id' => 1]);
        $this->delete("hairdresser", ['id' => 2]);
        $this->delete("hairdresser", ['id' => 3]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191215_203645_insert_test_data cannot be reverted.\n";

        return false;
    }
    */
}
