<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Service */

$this->title = "Услуга: " . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="service-view">

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
            'name',
            'description:ntext',
        ],
    ]) ?>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Парикмахеры предоставляющие услугу </h4>
            </div>
            <div class="card-body">
                <?php if ($model->serviceToHairdressers): ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                Id
                            </th>
                            <th>
                                Парикмахер
                            </th>
                            <th>
                                Цена
                            </th>
                            </thead>
                            <tbody>
                            <?php foreach ($model->serviceToHairdressers as $serviceToHairdresser): ?>
                                <tr>
                                    <td>
                                        <?= $serviceToHairdresser->hairdresser->id ?>
                                    </td>
                                    <td>
                                        <?= $serviceToHairdresser->hairdresser->getName() ?>
                                    </td>
                                    <td>
                                        <?= $serviceToHairdresser->price ?>
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
