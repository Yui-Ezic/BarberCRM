<?php


namespace frontend\models;


use common\models\Order;
use frontend\managers\ClientManager;
use frontend\managers\HairdresserManager;
use yii\base\Model;

class AppointmentForm extends Model
{
    public $service_id;
    public $hairdresser_id;
    public $date;
    public $time_from;
    public $first_name;
    public $last_name;
    public $phone;
    public $note;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id', 'hairdresser_id', 'phone'], 'integer'],
            [['service_id', 'hairdresser_id', 'date', 'time_from', 'first_name'], 'required'],
            [['first_name', 'last_name'], 'string', 'length' => [2, 24]],
            ['phone', 'string', 'length' => 10],
            ['note', 'string', 'min' => 6],
            ['date', 'date', 'format' => 'php:Y-m-d'],
            ['time_from', 'time', 'format' => 'H:i']
        ];
    }

    public function load($data, $formName = null) {
        $this->setAttributes($data);

        return true;
    }

    public function save() {
        $client = (new ClientManager())->findOrSave($this->first_name, $this->last_name, $this->phone);
        $order = new Order();

        $service_info = (new HairdresserManager())->getServiceInfo($this->hairdresser_id, $this->service_id);
        $duration = $service_info['duration'];
        $price = $service_info['price'];

        $order->client_id = $client->id;
        $order->service_id = $this->service_id;
        $order->hairdresser_id = $this->hairdresser_id;
        $order->date = $this->date;
        $order->start_time = $this->time_from;
        $order->duration = $duration;
        $order->paid = $price;
        $order->client_comment = $this->note;

        $order->save();

        return $order;
    }

}