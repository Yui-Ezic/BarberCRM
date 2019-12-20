<?php

/* @var $this yii\web\View */
/* @var $services[] common\models\Service */
/* @var $hairdressers[] common\models\Hairdresser */
/* @var $model common\models\Service */

$this->title = 'My Yii Application';

use \yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>
<section id="Header">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center">
            <div class="col text-center">
                <div class="header-title">
                    <h1>Парикмахерская <span class="text-selected">Соболев</span></h1>
                </div>
                <div class="header-button">
                    <a href="#Appointment" class="arrow-btn">
                        Записаться
                        <span class="arrow-btn-bg"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</section>

<section id="Appointment">
    <div class="container h-100">
        <div id="Screen">
            <div id="appointment_date_menu" style="display: flex;" class=" row h-100">
                <div class="col-md-12 text-center">
                    <div class="form-group">
                        <label id="datePickerTitle" for="dateTimeInput">Сперва выберите дату</label>
                        <input required class="form-control" type="date" id="dateTimeInput">
                    </div>
                    <a style="color: white;" class="btn btn-primary date_submit">Подтвердить</a>
                </div>
            </div>

            <div id="appointment_main_menu" style="display: none;" class=" row min-h-100">
                <div class="col-12 text-center">
                    <div class="menu_item main_menu_item" data-item="date">
                        <p>Дата</p>
                        <p class="appointment_date"></p>
                    </div>
                    <hr/>
                    <div class="menu_item main_menu_item" data-item="service">
                        <p>Услуга</p>
                        <p class="service_name"></p>
                    </div>
                    <hr/>
                    <div class="menu_item main_menu_item hairdresser_selector" data-item="hairdresser">
                        <p>Парикмахер</p>
                        <p class="hairdresser_name"></p>
                    </div>
                    <hr/>
                    <div class="menu_item main_menu_item client_selector" data-item="client">
                        <p>Информация о себе</p>
                        <p class="client_info"></p>
                    </div>
                    <div class="price_message">
                        <hr/> Цена: <span class="price"></span>
                    </div>
                    <div class="send_appointment">
                        <a href="#" class="arrow-btn send_appointment">
                            Отправить заявку
                            <span class="arrow-btn-bg"></span>
                        </a>
                    </div>
                </div>
            </div>

            <div id="appointment_service_menu" style="display: none;" class="row min-h-100">
            </div>

            <div id="appointment_hairdresser_menu" style="display: none;" class="row min-h-100">
            </div>

            <div id="appointment_client_menu" style="display: none;" class="row h-100">
                <div class="col-md-8 text-center">
                    <form id="clientForm">
                        <div class="form-group">
                            <label for="firstNameInput">Имя</label>
                            <input required class="form-control" type="text" name="first_name" id="firstNameInput">
                        </div>
                        <div class="form-group">
                            <label for="lastNameInput">Фамилия</label>
                            <input required class="form-control" type="text" name="last_name" id="lastNameInput">
                        </div>
                        <div class="form-group">
                            <label for="phoneInput">Телефон</label>
                            <input required class="form-control" type="tel" name="phone" id="phoneInput">
                        </div>
                        <div class="form-group">
                            <label for="noteInput">Комментарий</label>
                            <textarea class="form-control" type="text" name="note" id="noteInput"></textarea>
                        </div>
                        <button class="btn btn-primary js_client_back">Назад</button>
                        <button type="submit" class="btn btn-success">Подтвердить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>