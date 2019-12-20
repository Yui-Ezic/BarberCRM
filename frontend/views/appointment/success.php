<?php
/* @var $this \yii\web\View */
/* @var $order \common\models\Order */

?>

<div class="col-lg-8 text-center">
    <h3>Ваша запись успешно зарегестрированна</h3>
    <p class="op-5">Номер записи #<?= $order->id ?></p>
    <ul class="list-group appointment_info">
        <li class="list-group-item">Дата: <?= $order->date ?></li>
        <li class="list-group-item">Время: <?= $order->start_time ?></li>
        <li class="list-group-item">Парикмахер: <?= $order->hairdresser->first_name . ' ' . $order->hairdresser->last_name ?></li>
        <li class="list-group-item">Номер телефона: <?= $order->client->phone_number ?></li>
        <li class="list-group-item">Цена: <?= $order->paid ?></li>
    </ul>
</div>