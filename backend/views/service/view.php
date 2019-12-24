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
            <div class="card-header inline-title">
                <h4 class="card-title"> Парикмахеры предоставляющие услугу </h4>
                <a href="<?= \yii\helpers\Url::to(['service/add-hairdresser', 'service_id' => $model->id])?>" class="btn btn-success">Добавить парикмахера</a>
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
                                Длительность
                            </th>
                            <th>
                                Цена
                            </th>
                            <th>
                                Действия
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
                                        <?= $serviceToHairdresser->duration ?>
                                    </td>
                                    <td>
                                        <?= $serviceToHairdresser->price ?>
                                    </td>
                                    <td>
                                        <a href="<?= \yii\helpers\Url::to(['service/delete-hairdresser',
                                            'hairdresser_id' => $serviceToHairdresser->hairdresser_id,
                                            'service_id' => $serviceToHairdresser->service_id])
                                        ?>" onclick="return confirm('Delete entry?')">
                                            <i class="action-btn fa fa-trash"></i>
                                        </a>
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
