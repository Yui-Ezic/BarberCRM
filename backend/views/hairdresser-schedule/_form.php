<?php

use common\models\Hairdresser;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HairdresserSchedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hairdresser-schedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hairdresser_id')->dropDownList(ArrayHelper::map(Hairdresser::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'from_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'to_time')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
