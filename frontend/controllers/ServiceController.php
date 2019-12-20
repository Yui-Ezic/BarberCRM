<?php

namespace frontend\controllers;

use common\models\Service;
use Yii;

class ServiceController extends \yii\web\Controller
{
    public $layout = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionList() {
        $post_data = Yii::$app->request->post();
        $services = Service::find()->all();
        return $this->render('list', ['services' => $services]);
    }

}
