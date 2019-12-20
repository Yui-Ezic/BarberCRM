<?php


namespace frontend\managers;


use common\models\Client;

class ClientManager
{
    public function findOrSave($first_name, $last_name, $phone):Client {
        $client = Client::findOne(['phone_number' => $phone]);

        if ($client) {
            return $client;
        }

        $client = new Client();
        $client->first_name = $first_name;
        $client->last_name = $last_name;
        $client->phone_number = $phone;
        $client->save();

        return $client;
    }
}