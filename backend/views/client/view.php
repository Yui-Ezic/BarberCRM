<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Client */

$this->title = "Клиент #" . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="client-view">

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
            'first_name',
            'last_name',
            'phone_number',
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
                            Парикмахер
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
                                <?= $order->hairdresser->getName() ?>
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
    </div>
</div>
