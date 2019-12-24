<?php
/* @var $this yii\web\View */
/* @var $model ServiceToHairdresser */
/* @var $hairdresser_list[] \common\models\Hairdresser */

$this->title = 'Добавление парикмахера к услуге';
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['view', 'id' => $model->service_id]];
$this->params['breadcrumbs'][] = $this->title;

use common\models\Service;
use common\models\ServiceToHairdresser;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;


?>

<div class="service-create">

    <?php if(!count($hairdresser_list)): ?>

    <div>
        <h4 class="op-5">Не найденно парикмехеров которые еще не предоставляют данную услугу</h4>

        <a href="<?= \yii\helpers\Url::to(['service/view', 'id' => $model->service_id])?>" class="btn btn-primary">
            Вернуться назад
        </a>
    </div>

    <?php else: ?>

    <div class="service-to-hairdresser-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'service_id')
            ->dropDownList(ArrayHelper::map(Service::find()->all(), 'id', 'name'), [
                    'disabled' => true
            ]) ?>

        <?= $form->field($model, 'hairdresser_id')
            ->dropDownList(ArrayHelper::map($hairdresser_list, 'id', 'name'))
        ?>

        <?= $form->field($model, 'duration')->textInput(['type' => 'number']) ?>

        <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <?php endif?>

</div>

