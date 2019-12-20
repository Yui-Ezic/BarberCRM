<?php

namespace frontend\managers;

use common\models\HairdresserSchedule;
use yii\helpers\ArrayHelper;

class ScheduleManager
{
    /**
     * Интервал в минутах с которым следует создавать слоты для записи
     */
    public const INTERVAL = 30;


    /**
     * Возвращает список свободных для записи слотов парикмахера на определенную дату.
     * @param int $hairdresser_id
     * @param string $date дата в формате "год-месяц-число"
     * @param int $duration длительность услуги
     * @return array
     */
    public function getFreeSlots(int $hairdresser_id, string $date, int $duration): array {
        $hairdresserManager = new HairdresserManager();
        $schedule = $hairdresserManager->getScheduleByDate($hairdresser_id, $date);

        if (!$schedule) {
            return [];
        }

        $start_time = $schedule->from_time;
        $end_time = $schedule->to_time;
        $slots = (new TimeManager())->splitBySlots($start_time, $end_time, self::INTERVAL);

        $busy_slots = $hairdresserManager->getBusySlots($hairdresser_id, $date);

        foreach ($busy_slots as $busy_slot) {
            ArrayHelper::removeValue($slots, $busy_slot);
        }

        return $slots;
    }

}