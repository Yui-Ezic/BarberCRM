<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->dropDownList(ArrayHelper::map(\common\models\Client::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'service_id')->dropDownList(ArrayHelper::map(\common\models\Service::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'hairdresser_id')->dropDownList(ArrayHelper::map(\common\models\Hairdresser::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'start_time')->textInput(['maxlength' => true, 'type' => 'time']) ?>

    <?= $form->field($model, 'duration')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'paid')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'client_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hairdresser_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatusNames()) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
