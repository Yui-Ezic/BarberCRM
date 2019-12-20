<?php

/* @var $this yii\web\View */

$this->title = 'Главная';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать :)</h1>
        <p class="lead">Это приложение для управленя парикмахерской</p>
        <hr class="my-4">
        <p>Сделанно в качестве курсовой работы Михаила Зуева ТР-71 КПИ 2019</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-12">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Управление заказами
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <p>С помощью этого приложения вы можете легко управлять заказами в своей парикмахерской.</p>
                                <p>Для этого выберите в меню слева пункт "Заказы".
                                    Перед вами откроется список всех заказов, отсортированных по статусу и дате.</p>
                                <br/>
                                <h6>Поиск </h6>
                                <hr class="my-4">
                                <p>Для простоты использования реализован умный поиск со следующими возможностями:</p>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <p class="mt-0 mb-1"><b>Поиск по многим полям, даже тем которые не отображаются</b></p>
                                        Просто введите хоть что-то, что вы помните и с большой вероятностью - найдете то что нужно!
                                    </li>
                                    <li class="list-group-item">
                                        <p class="mt-0 mb-1"><b>Устойчивость к регистру</b></p>
                                        Теперь можете писать имена с маленькой буквы :)
                                    </li>
                                    <li class="list-group-item">
                                        <p class="mt-0 mb-1"><b>Скорость</b></p>
                                        Не нужно долго ждать, я об этом позаботился.
                                    </li>
                                </ul>
                                <br/><br/>
                                <h6>Доступ на основе ролей </h6>
                                <hr class="my-4">
                                <p>А это пока что не сделанно :(  <br/> Но будет в скором времени!</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Управление клиентами
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                Пока что не готово :(
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Удбная статистика
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                Пока что не готово :(
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
