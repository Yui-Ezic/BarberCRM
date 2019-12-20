<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Услуги';
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
                        <?= Html::a('Добавить услугу', ['create'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
                <p class="card-category"></p>
            </div>

            <?php Pjax::begin(); ?>
            <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

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
                    'name',
                    'description:ntext',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update}',
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
