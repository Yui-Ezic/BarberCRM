<?php

/* @var $this View */

/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use backend\widgets\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use common\widgets\Alert;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
        <div class="logo">
            <a href="<?= \yii\helpers\Url::to(['/site/index'])?>" class="simple-text logo-mini">
                <div class="logo-image-small">
                    <img src="/img/logo-small.png">
                </div>
            </a>
            <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                Парикмахерская
            </a>
        </div>
        <div class="sidebar-wrapper">
            <?php
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems = [
                    ['label' => "<i class='nc-icon nc-bank'></i> Главная", 'url' => ['/site/index']],
                    ['label' => "<i class='nc-icon nc-tile-56'></i> Заказы", 'url' => ['/order/index']],
                    ['label' => "<i class='nc-icon nc-circle-10'></i> Клиенты", 'url' => ['/client/index']],
                    ['label' => "<i class='nc-icon nc-badge'></i> Парикмахеры", 'url' => ['/hairdresser/index']],
                    ['label' => "<i class='nc-icon nc-calendar-60'></i> График работы", 'url' => ['/hairdresser-schedule/index']],
                    ['label' => "<i class='nc-icon nc-briefcase-24'></i> Услуги", 'url' => ['/service/index']],
                ];
                $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>';
            }
            echo Nav::widget([
                'encodeLabels' => false,
                'options' => ['class' => 'nav'],
                'items' => $menuItems,
            ]);
            ?>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="#pablo"><?= $this->title ?></a>
                </div>
            </div>
        </nav>
        <div class="content">
            <!--?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?-->
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
        <footer class="footer footer-black  footer-white ">
            <div class="container-fluid">
                <div class="row">
                    <nav class="footer-nav">
                        <ul>
                            <li>
                                <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>
                            </li>
                            <li>
                                <a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
                            </li>
                            <li>
                                <a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script> Cделано с <i class="fa fa-heart heart"></i> от Зуева
              </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
