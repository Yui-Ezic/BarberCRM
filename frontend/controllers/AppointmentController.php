<?php

namespace frontend\controllers;

use Yii;
use frontend\models\AppointmentForm;

class AppointmentController extends \yii\web\Controller
{
    public $layout = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $form = new AppointmentForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $order = $form->save();
            return $this->render("success", ['order' => $order]);
        }

        return $this->render("error", ['form' => $form]);
    }

}
