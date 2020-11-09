<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные данные</a>
                    </li>
                </ul>
                <br>

                <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                <link rel="stylesheet" href="/resources/demos/style.css">
                <link rel="stylesheet"
                      href="https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.css">
                <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <script src="https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js"></script>

                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="time">Время</label>
                            <input name="time" value="{{ $item->time or old('time')}}"
                                   id="datepicker"
                                   type="text"
                                   class="form-control"
                                   autocomplete="off"
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
                            $("#datepicker").datetimepicker({
                                dateFormat: "yy-mm-dd",
                                timeFormat: "hh:mm:ss",
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
                            <label for="guest_id">Гость</label>
                            <select name="guest_id"
                                    id="guest_id"
                                    class="form-control"
                                    required>
                                @foreach($guestList as $guestOption)
                                    <option value="{{ $guestOption->id }}"
                                            @if($guestOption->id == $item->guest_id) selected @endif>
                                        {{ $guestOption->id or old('id')}}. {{ $guestOption->name or old('name')}}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>