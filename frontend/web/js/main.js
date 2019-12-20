$(document).ready(function() {
    $("#Header").on("click", "a", function(event) {
        //отменяем стандартную обработку нажатия по ссылке
        event.preventDefault();

        //забираем идентификатор бока с атрибута href
        let id = $(this).attr('href'),

            //узнаем высоту от начала страницы до блока на который ссылается якорь
            top = $(id).offset().top;

        //анимируем переход на расстояние - top за 1500 мс
        $('body,html').animate({ scrollTop: top }, 1500);
    });

    let screen = $("#Screen");

    let loading_page = "<div class=\"col-md-12 text-center\">\n" +
        "                   <div class='spinner-border text-warning' role='status'>" +
        "                       <span class='sr-only'>Loading...</span>" +
        "                   </div>" +
        "               </div>";

    let service_id = false;
    let service_name = "Не выбранно";

    let hairdresser_id = false;
    let hairdresser_name = "Не выбранно";

    let appointment_date = "";

    let time_from = false;

    let price = 0;

    let client_first_name = "";
    let client_last_name = "";
    let client_phone_number = "";
    let client_note = "";

    /**
     * Превращает все данные в единный массив
     * @returns {{date: *, note: *, time_from: *, phone: *, service_id: *, last_name: *, hairdresser_id: *, first_name: *}}
     */
    function get_data_array() {
        return {
            'service_id' : service_id,
            'hairdresser_id' : hairdresser_id,
            'date' : appointment_date,
            'time_from' : time_from,
            'first_name': client_first_name,
            'last_name' : client_last_name,
            'phone' : client_phone_number,
            'note' : client_note
        }
    }

    function refresh_service() {
        service_id = false;
        service_name = "Не выбранно";
    }

    function refresh_hairdresser() {
        hairdresser_id = false;
        hairdresser_name = "Не выбранно";

        time_from = false;
        price = 0;
    }

    function refresh_all() {
        refresh_service();
        refresh_hairdresser();
    }

    /**
     * Проверяет правильность всех заполненных данных
     */
    function verification_appointment() {
        if (hairdresser_id && service_id && appointment_date && time_from && client_first_name) {
            return true;
        }

        return false;
    }

    /**
     * Запрашивает данные о текущих услугах и обновляет страницу с услугами
     */
    function update_service_menu() {
        $("#appointment_service_menu").html(loading_page);
        // ajax получение данных
        data = get_data_array();
        $.ajax({
            url: "/service/list",
            type: "POST",
            data: data,
            success: function (response) {
                $("#appointment_service_menu").html(response);
            },
            dataType: "html"
        });
    }

    /**
     * Запрашивает данные о подходящих парикмахерах и обновляет страницу с ними
     */
    function update_hairdresser_menu() {
        $("#appointment_hairdresser_menu").html(loading_page);
        // ajax получение данных
        data = get_data_array();
        $.ajax({
            url: "/hairdresser/list",
            type: "POST",
            data: data,
            success: function (response) {
                $("#appointment_hairdresser_menu").html(response);
            },
            dataType: "html"
        });
    }

    /**
     * Обновляет главное меню на основе выбранных данных
     */
    function update_main_menu() {
        if (service_id) {
            $(".hairdresser_selector").removeClass("disabled");
        } else {
            $(".hairdresser_selector").addClass("disabled");
            refresh_hairdresser()
        }

        $(".appointment_date").html(appointment_date);
        $(".service_name").html(service_name);
        $(".client_info").html(get_client_info());

        if (time_from) {
            $(".hairdresser_name").html(hairdresser_name + ": " + time_from);
        } else {
            $(".hairdresser_name").html(hairdresser_name);
        };

        if (price) {
            $(".price_message").show();
            $(".price").html(price);
        } else {
            $(".price_message").hide();
            $(".price").html("???");
        }

        if (verification_appointment()) {
            $(".send_appointment").show();
        } else {
            $(".send_appointment").hide();
        }
    }

    /**
     * Отобразить главное меню
     */
    function show_main_menu() {
        console.log("Show main menu");
        update_main_menu();
        $("#appointment_main_menu").show();
    }

    /**
     * Скрыть главное меню
     */
    function hide_main_menu() {
        console.log("Hide main menu");
        $("#appointment_main_menu").hide();
    }

    /**
     * Отобразить меню выбора услуг
     */
    function show_service_menu() {
        console.log("Show service menu");
        update_service_menu();
        $("#appointment_service_menu").css("display", "flex");
    }

    /**
     * Скрыть меню выбора услуг
     */
    function hide_service_menu() {
        console.log("Hide service menu");
        $("#appointment_service_menu").hide();
    }

    /**
     * Отобразить меню выбора парикмахера
     */
    function show_hairdresser_menu() {
        console.log("Show hairdresser menu");
        update_hairdresser_menu();
        $("#appointment_hairdresser_menu").css("display", "flex");
    }

    /**
     * Скрыть меню выбора парикмахера
     */
    function hide_hairdresser_menu() {
        console.log("Hide hairdresser menu");
        $("#appointment_hairdresser_menu").hide();
    }

    /**
     * Отобразить меню выбора даты
     */
    function show_date_menu(message = false) {
        console.log("Show date menu");
        if (message) {
            $("#datePickerTitle").html(message);
        }
        $("#appointment_date_menu").css("display", "flex");
    }

    /**
     * Скрыть меню выбора даты
     */
    function hide_date_menu() {
        console.log("Hide date menu");
        $("#appointment_date_menu").hide();
    }

    /**
     * Отобразить меню заполнения информации о клиенте
     */
    function show_client_menu() {
        console.log("Show client menu");
        $("#appointment_client_menu").css("display", "flex");
    }

    /**
     * Скрыть меню заполнения информации о клиенте
     */
    function hide_client_menu() {
        console.log("Hide client menu");
        $("#appointment_client_menu").hide();
    }

    /**
     * Генерирует строку с информацией о клиенте
     */
    function get_client_info() {
        info = "";
        if (client_first_name) {
            info += client_first_name + " ";
        }
        if (client_last_name) {
            info += client_last_name;
        }
        if (client_phone_number) {
            if (info) {
                info += ": " + client_phone_number;
            } else {
                info += client_phone_number;
            }
        }

        if (!info) {
            info = "Заполните пожалуйста информацию о себе"
        }

        return info;
    }


    /**
     * Клик по "Сбросить выбор услуги"
     */
    $("#Appointment").on("click", '.refresh_service', function(event) {
        refresh_service();
        hide_service_menu();
        show_main_menu();
    });

    /**
     * Клик по "Отменить парикмахера"
     */
    $("#Appointment").on("click", '.refresh_hairdresser', function(event) {
        refresh_hairdresser();
        hide_hairdresser_menu();
        show_main_menu();
    });

    /**
     *  Обработка клика выбора даты
     */
    $("#Appointment").on("click", '.date_submit', function(event) {
        refresh_all();
        date = $('#dateTimeInput').val();
        if (date) {
            appointment_date = date;
            hide_date_menu();
            show_main_menu();
        }
    });

    /**
     *  Обработка клика по пункту главного меню
     */
    $("#Appointment").on("click", '.main_menu_item', function(event) {
        item = this.getAttribute("data-item");
        console.log("Click on " + item + " item");
        hide_main_menu();
        if (item == "service") {
            show_service_menu();
        } else if (item == "hairdresser") {
            show_hairdresser_menu();
        } else if (item == "date") {
            show_date_menu("Выберите новую дату");
        } else if (item == "client") {
            show_client_menu();
        } else {
            show_main_menu();
        }

    });


    /**
     * Обработка клика выбора услуги
     */
    $("#Appointment").on("click", '.service_menu_item', function(event) {
        id = this.getAttribute("data-id");
        local_name = this.getAttribute("data-name");

        console.log("Click on item with id = " + id + " and name = " + local_name);

        service_id = id;
        service_name = local_name;

        refresh_hairdresser();

        hide_service_menu();
        show_main_menu();
    });

    /**
     * Обработка клика выбора парикмахера
     */
    $("#Appointment").on("click", '.hairdresser_menu_item', function(event) {
        event.preventDefault();
        id = this.getAttribute("data-id");
        local_name = this.getAttribute("data-name");
        time = this.getAttribute("data-time");
        local_price = this.getAttribute("data-price");
        console.log("Click on item with id = " + id + " and name = " + local_name + " to time = " + time + " price = " + local_price);
        hairdresser_id = id;
        hairdresser_name = local_name;
        time_from = time;
        price = local_price;
        console.log("price global = " + price);
        hide_hairdresser_menu();
        show_main_menu();
    });

    /**
     * Обработка клика по кнопке "Вернуться назад" из меню заполнения информации о клиенте.
     * Отображает главное меню
     */
    $("#Appointment").on("click", '.js_client_back', function(event) {
        event.preventDefault();
        hide_client_menu();
        show_main_menu();
    });

    /**
     * Обработка формы с информацией о клиенте
     */
    $("#clientForm").submit(function(event) {
        event.preventDefault();
        form_data = $(this).serializeArray().reduce(function(obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});

        console.log("Client form data");
        console.log(form_data);

        client_first_name = form_data['first_name'];
        client_last_name = form_data['last_name'];
        client_phone_number = form_data['phone'];
        client_note = form_data['note'];

        hide_client_menu();
        show_main_menu();
    });

    let is_sending = false;

    /**
     * Обработка клика по кнопке "Вернуться назад" из меню заполнения информации о клиенте.
     * Отображает главное меню
     */
    $("#Appointment").on("click", '.send_appointment', function(event) {
        event.preventDefault();
        if (!verification_appointment()) {
            update_main_menu();
            return;
        }

        if (is_sending) {
            return;
        }

        // Создание заявки
        data = get_data_array();
        console.log(data);
        is_sending = true;
        $.ajax({
            url: "/appointment/create",
            type: "POST",
            data: data,
            success: function (response) {
                console.log(response);
                is_sending = false;
                $("#appointment_main_menu").html(response);
            },
            dataType: "html"
        });
    });
});