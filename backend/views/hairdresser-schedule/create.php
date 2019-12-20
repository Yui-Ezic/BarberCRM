<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HairdresserSchedule */

$this->title = 'Добавление графика';
$this->params['breadcrumbs'][] = ['label' => 'Hairdresser Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hairdresser-schedule-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
