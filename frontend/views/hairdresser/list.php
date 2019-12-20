<?php
/* @var $this yii\web\View */
/* @var $hairdressers[] Список парикмахеров с услугой*/

?>
<div class="col-lg-8">
    <div class="menu_item refresh_hairdresser">
        Отменить выбор
    </div>

    <?php if (count($hairdressers) == 0): ?>
        <h3 class="op-5 text-center">К сожалению, не найденно ни одного парикмахера с подходящими параметрами :(</h3>
    <?php endif; ?>

    <?php foreach ($hairdressers as $hairdresser): ?>
        <div class="hairdresser">
            <div class="hairdresser-image center-cropped" style='background-image: url("images/hairdresser.png")'>
                <img src="images/hairdresser.png">
            </div>
            <div class="hairdresser-info">
                <div class="hairdresser-info-top">
                    <div class="hairdresser-info-name">
                        <?= $hairdresser['first_name'] . " " . $hairdresser['last_name'] ?>
                    </div>
                    <div class="hairdresser-info-price text-center">
                        <?= $hairdresser['price'] ?> UAH
                    </div>
                </div>
                <div class="hairdresser-info-description">
                    <?= $hairdresser['description'] ?>
                </div>
                <div class="hairdresser-info-schedule">
                    <?php foreach ($hairdresser['intervals'] as $interval): ?>
                    <a href="" class="hairdresser_menu_item" data-id="<?= $hairdresser['id'] ?>" data-name="<?= $hairdresser['first_name'] . " " . $hairdresser['last_name'] ?>" data-time="<?= $interval ?>" data-price="<?= $hairdresser['price'] ?>">
                        <?= $interval ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

