<div class="card-title"></div>
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные данные</a>
    </li>
</ul>
<br>
<div class="tab-content">
    <div class="tab-pane active" id="maindata" role="tabpanel">
        <div class="form-group">
            <label for="name">Имя</label>
            <input name="name" value="{{ $item->name or old('name') }}"
                   id="name"
                   type="text"
                   class="form-control"
                   minlength="3"
                   required>
        </div>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <div class="form-group datepicker">
            <label for="birthday">Дата рождения</label>
            <input name="birthday" value="{{ $item->birthday or old('birthday')}}"
                   id="datepicker"
                   type="text"
                   autocomplete="off"
                   class="form-control"
                   minlength="3"
                   required>
        </div>

        <script>
            $.datepicker.regional['ru'] = {
                closeText: "Закрыть",
                prevText: "&#x3C;Пред",
                nextText: "След&#x3E;",
                currentText: "Сегодня",
                monthNames: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
                    "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
                monthNamesShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн",
                    "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
                dayNames: ["воскресенье", "понедельник", "вторник", "среда", "четверг", "пятница", "суббота"],
                dayNamesShort: ["вск", "пнд", "втр", "срд", "чтв", "птн", "сбт"],
                dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                weekHeader: "Нед",
                dateFormat: "dd.mm.yy",
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ""
            };
            $.datepicker.setDefaults($.datepicker.regional['ru']);
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                maxDate: '0',
                weekStart: 0,
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true,
                rtl: true,
                orientation: "auto"
            });
        </script>

        <div class="form-group">
            <label for="gender">Пол</label>
            <select name="gender"
                    id="gender"
                    class="form-control"
                    required>
                <option value="мужской">мужской</option>
                <option value="женский">женский</option>
            </select>
        </div>
    </div>
</div>