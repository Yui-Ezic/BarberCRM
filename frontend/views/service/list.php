<?php
/* @var $this yii\web\View */
/* @var $services[] \common\models\Service */
?>

<div class="col-md-8 text-center">
    <div class="menu_item refresh_service">
        Сбросить услугу
    </div>
    <?php foreach ($services as $service): ?>
    <?php /* @var $service \common\models\Service */ ?>
        <a class="menu_item service_menu_item" data-id="<?= $service->id ?>" data-name="<?= $service->name ?>">
            <?= $service->name ?>
        </a>
    <?php endforeach; ?>
</div>