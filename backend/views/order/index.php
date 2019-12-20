<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row ">

    <div class="col-md-12">
        <div class="card card-plain">
            <div class="card-header">
                <div class="card-title">
                    <h4 class="card-title" style="float: left">
                        <?= Html::encode($this->title) ?>
                    </h4>
                    <div class="card-right-button">
                        <?= Html::a('Новая заявка', ['create'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
                <p class="card-category"></p>
            </div>

            <?php Pjax::begin([
                'options' => [
                    'class' => 'card-body',
                ]
            ]); ?>
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'layout' => "{items}\n{pager}",
                'options' => [
                    'class' => 'table-responsive'
                ],
                'tableOptions' => [
                    'class' => 'table'
                ],
                'columns' => [
                    'id',
                    //'client_id',
                    //'service_id',
                    //'hairdresser_id',
                    'date',
                    [
                        'attribute' => 'client_id',
                        'format' => 'raw',
                        'value' => function (\common\models\Order $order) {
                            return Html::a($order->getClientName(), ['client/view', 'id' => $order->client_id]);
                        }
                    ],
                    'paid',
                    [
                            // Статус заказа в виде бутстрап кнопки
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => function (\common\models\Order $order) {
                                return Html::button($order->getStatusName(), ['class' => 'btn btn-' . $order->getStatusColor()]);
                            }
                    ],
                    //'client_comment:ntext',
                    //'hairdresser_comment:ntext',
                    //'status',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a("<i class='action-btn fa fa-eye'></i>", $url);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a("<i class='action-btn fa fa-edit'></i>", $url);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a("<i class='action-btn fa fa-trash'></i>", $url, [
                                    'data-confirm' => Yii::t('yii', 'Вы уверенны что хотите удалить?'),
                                    'data-method' => 'post',
                                ]);
                            },
                        ]
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
