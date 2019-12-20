<?php

namespace frontend\controllers;

use frontend\managers\HairdresserManager;
use frontend\managers\ScheduleManager;
use Yii;

class HairdresserController extends \yii\web\Controller
{
    public $layout = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionList()
    {
        $post_data = Yii::$app->request->post();
        $service_id = $post_data['service_id'];
        $date = $post_data['date'];
        $hairdressers = (new HairdresserManager())->getHairdresserInfoForAppointment($service_id, $date);
        return $this->render("list", ['hairdressers' => $hairdressers]);
    }

}
