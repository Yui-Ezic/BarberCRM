<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HairdresserSchedule */

$this->title = 'Редактирование графика: ' .  $model->getHairdresserName() . ' ' . $model->date;
$this->params['breadcrumbs'][] = ['label' => 'Hairdresser Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="hairdresser-schedule-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
