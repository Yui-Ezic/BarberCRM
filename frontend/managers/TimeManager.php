<?php


namespace frontend\managers;


class TimeManager
{
    /**
     * Преобразует время в формате "Часы:Минуты" в минуты
     * @param $time
     * @return float|int
     */
    public function toMinutes($time) {
        $tmp = explode(":", $time);
        $hours = $tmp[0];
        $minutes = $tmp[1];
        $total_minutes = $minutes + $hours * 60;
        return $total_minutes;
    }

    /**
     * Преобразует минуты в формат "Часы:Минуты"
     * @param $time
     * @return string
     */
    public function toHoursFormat($time) {
        $hours = (int) ($time / 60);
        $minutes = $time % 60;
        if ($minutes == 0) {
            $minutes = "00";
        }
        return "$hours:$minutes";
    }

    /**
     * Увеличивает указанное временя
     * @param $start string Время в формате "Часы:Минуты"
     * @param $duration string Длительность в минутах
     * @return string Время + длительность в формате "Часы:Минуты"
     */
    public function addDuration($start, $duration) {
        $minutes = $this->toMinutes($start) + (int)$duration;
        return $this->toHoursFormat($minutes);
    }

    /**
     * Ращзбивает время на слоты по заданным интервалам
     * @param string $start
     * @param string $end
     * @param int $interval
     * @return array
     */
    public function splitBySlots(string $start, string $end, int $interval):array {
        $timeManager = new TimeManager();
        $start = $timeManager->toMinutes($start);
        $end = $timeManager->toMinutes($end);

        $slots = [];
        while ($start <= $end) {
            $slots[] = $timeManager->toHoursFormat($start);
            $start += $interval;
        }

        return $slots;
    }
}