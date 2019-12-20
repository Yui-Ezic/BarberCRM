<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Hairdresser */

$this->title = 'Редактирование парикмахера: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hairdressers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="hairdresser-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
