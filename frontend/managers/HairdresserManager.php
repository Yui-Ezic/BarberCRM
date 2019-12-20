<?php
namespace frontend\managers;

use common\models\Hairdresser;
use common\models\HairdresserSchedule;
use common\models\Order;
use common\models\Service;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class HairdresserManager
{
    /**
     * Информация о парикмахере вместе с свободными часами работы, информацией о услуге.
     * Используется для отображения парикмахеров для записи на прием.
     * @param $service_id int
     * @param $date string Число для записи в формате "год-месяц-день"
     * @return array
     */
    public function getHairdresserInfoForAppointment($service_id, $date):array {
        // Выбор всех парикмахеров предомтавляющих нужную услугу
        $hairdressers = (new Query())->select(["hairdresser.*", "service_to_hairdresser.duration", "service_to_hairdresser.price"])
            ->from("hairdresser")
            ->innerJoin('service_to_hairdresser', 'hairdresser.id = service_to_hairdresser.hairdresser_id')
            ->innerJoin('hairdresser_schedule', 'hairdresser.id = hairdresser_schedule.hairdresser_id')
            ->where(['service_to_hairdresser.service_id' => $service_id])
            ->andWhere(['date' => $date])
            ->andWhere(['<>', 'hairdresser.status', Hairdresser::STATUS_FIRED])
            ->all();

        // Добавляем каждому парикмахеру информацию про свободные слоты для записи
        $scheduleManager = new ScheduleManager();
        foreach ($hairdressers as &$hairdresser) {
            $hairdresser['intervals'] = $scheduleManager->getFreeSlots($hairdresser['id'], $date, $hairdresser['duration']);
        }

        return $hairdressers;
    }

    /**
     * @param $hairdresser_id
     * @param $service_id
     * @return array|bool
     */
    public function getServiceInfo($hairdresser_id, $service_id) {
        $service = (new Query())->select(["service.name", "service_to_hairdresser.duration", "service_to_hairdresser.price"])
            ->from("service_to_hairdresser")
            ->innerJoin('service', 'service.id = service_to_hairdresser.service_id')
            ->where(['service_to_hairdresser.service_id' => $service_id])
            ->andWhere(['service_to_hairdresser.hairdresser_id' => $hairdresser_id])
            ->one();

        return $service;
    }

    /**
     * @param $hairdresser_id
     * @param $date
     * @return array|HairdresserSchedule|\yii\db\ActiveRecord|null
     */
    public function getScheduleByDate($hairdresser_id, $date) {
        $schedule = HairdresserSchedule::find()
            ->where(['hairdresser_id' => $hairdresser_id])
            ->andWhere(["date" => $date])
            ->one();
        return $schedule;
    }

    public function getBusySlots($hairdresser_id, $date) {
        $orders = Order::find()
            ->where(['hairdresser_id' => $hairdresser_id])
            ->andWhere(['date' => $date])
            ->andWhere(['<>','status', Order::STATUS_CANCELED])
            ->all();

        $timeManager = new TimeManager();
        $slots = [];
        foreach ($orders as $order) {
            $start_time = $order->start_time;
            $end_time = $timeManager->addDuration($start_time, $order->duration);
            $tmp = $timeManager->splitBySlots($start_time, $end_time, ScheduleManager::INTERVAL);
            $slots = ArrayHelper::merge($slots, $tmp);
        }

        return $slots;
    }
}