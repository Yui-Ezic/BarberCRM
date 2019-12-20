<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = "Заказ #" . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">
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
            [
                'label' => "Клиент",
                'attribute' => 'client_id',
                'format' => 'raw',
                'value' => function (\common\models\Order $order) {
                    return Html::a($order->getClientName(), ['client/view', 'id' => $order->client_id]);
                }
            ],
            [
                'attribute' => 'hairdresser_id',
                'format' => 'raw',
                'value' => function (\common\models\Order $order) {
                    return Html::a($order->getHairdresserName(), ['client/view', 'id' => $order->hairdresser_id]);
                }
            ],
            [
                'attribute' => 'service_id',
                'format' => 'raw',
                'value' => function (\common\models\Order $order) {
                    return $order->getServiceName();
                }
            ],
            'date',
            'start_time',
            'duration',
            'paid',
            'client_comment:ntext',
            'hairdresser_comment:ntext',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function (\common\models\Order $data) {
                    return Html::button($data->getStatusName(), ['class' => 'btn btn-' . $data->getStatusColor()]);
                }
            ],
        ],
    ]) ?>

</div>
