<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HairdresserSchedule */

$this->title = "График: " . $model->getHairdresserName() . ' ' . $model->date;
$this->params['breadcrumbs'][] = ['label' => 'Hairdresser Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hairdresser-schedule-view">
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'hairdresser_id',
                'format' => 'raw',
                'value' => function (\common\models\HairdresserSchedule $schedule) {
                    return Html::a($schedule->getHairdresserName(), ['hairdresser/view', 'id' => $schedule->hairdresser]);
                }
            ],
            'date',
            'from_time',
            'to_time',
        ],
    ]) ?>

</div>


