<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Hairdresser */

$this->title = 'Добавление парикмахера';
$this->params['breadcrumbs'][] = ['label' => 'Hairdressers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hairdresser-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
