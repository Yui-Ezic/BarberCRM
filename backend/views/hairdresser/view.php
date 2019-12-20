<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Hairdresser */

$this->title = $model->getName();
$this->params['breadcrumbs'][] = ['label' => 'Hairdressers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hairdresser-view">
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($model->status != \common\models\Hairdresser::STATUS_FIRED): ?>
            <?= Html::a('Уволить', ['fire', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверенны что хотите уволить?',
                    'method' => 'post',
                ],
            ]) ?>
        <? else: ?>
            <?= Html::a('Восстановить', ['hire', 'id' => $model->id], [
                'class' => 'btn btn-secondary',
                'data' => [
                    'confirm' => 'Вы уверенны что хотите восстановить?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'description:ntext',
            'photo',
            [
                // Статус заказа в виде бутстрап кнопки
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function (\common\models\Hairdresser $hairdresser) {
                    return Html::button($hairdresser->getStatusName(), ['class' => 'btn btn-' . $hairdresser->getStatusColor()]);
                }
            ],
        ],
    ]) ?>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Последние заказы </h4>
            </div>
            <div class="card-body">
                <?php if ($model->orders): ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                Id
                            </th>
                            <th>
                                Дата
                            </th>
                            <th>
                                Клиент
                            </th>
                            <th>
                                Оплаченно
                            </th>
                            </thead>
                            <tbody>
                            <?php foreach ($model->orders as $order): ?>
                                <tr>
                                    <td>
                                        <?= $order->id ?>
                                    </td>
                                    <td>
                                        <?= $order->date ?>
                                    </td>
                                    <td>
                                        <?= $order->client->getName() ?>
                                    </td>
                                    <td>
                                        <?= $order->paid ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p style="opacity: 0.5">Не найденно</p>
                <?php endif; ?>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Ближайжий график </h4>
            </div>
            <div class="card-body">
                <?php if ($schedules = $model->getNearestSchedule()): ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                Id
                            </th>
                            <th>
                                Дата
                            </th>
                            <th>
                                Время
                            </th>
                            </thead>
                            <tbody>
                            <?php foreach ($schedules as $schedule): ?>
                                <tr>
                                    <td>
                                        <?= $schedule->id ?>
                                    </td>
                                    <td>
                                        <?= $schedule->date ?>
                                    </td>
                                    <td>
                                        <?= $schedule->from_time . ' - ' . $schedule->to_time ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p style="opacity: 0.5">Не найденно</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
