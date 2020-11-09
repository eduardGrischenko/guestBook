@extends('layouts.app')

@section('content')
    <div class="statistic-form">
        <form class="form-panel" id="form">
            {{ csrf_field() }}
            <label for="month">Месяц</label>
            <select class="form-control" name="month" id="month" style="margin: 0 20px">
                <option value="01">Январь</option>
                <option value="02">Февраль</option>
                <option value="03">Март</option>
                <option value="04">Апрель</option>
                <option value="05">Май</option>
                <option value="06">Июнь</option>
                <option value="07">Июль</option>
                <option value="08">Сентябрь</option>
                <option value="09">Сентябрь</option>
                <option value="10">Октябрь</option>
                <option value="11">Ноябрь</option>
                <option value="12">Декабрь</option>
            </select>

            <label for="day">День</label>
            <select class="form-control" name="day" id="day" style="margin: 0 20px">
                <option value="all">За весь месяц</option>
                <option value="1">Понедельник</option>
                <option value="2">Вторник</option>
                <option value="3">Среда</option>
                <option value="4">Четверг</option>
                <option value="5">Пятница</option>
                <option value="6">Суббота</option>
                <option value="0">Воскресенье</option>
            </select>
        </form>

        <div class="card-body">
            <button class="btn btn-primary" id="buttonOne">Отобразить</button>
        </div>
    </div>

    <br>

    <div class="results">
        <div id="result-container-counts" class="result-container-counts">
        </div>

        <div id="result-container-topTenGuests" class="result-container-topTenGuests">
        </div>

        <div id="result-container-topTenAges" class="result-container-topTenAges">
        </div>
    </div>


    @push('scripts')
        <script>
            let buttonOne = $("#buttonOne");
            buttonOne.click(function () {
                $.ajax({
                    type: 'POST',
                    url: '/statistic',
                    data: $('#form').serialize(),
                    success: function (data) {
                        let resultData = '<table><tr><th>Кол-во гостей с уникальным ФИО:</th><th>' + data.guestsUniqueNames + '</th></tr>';
                        resultData += '<tr><th>Кол-во гостей старше 18 лет:</th><th>' + data.guestsOverEighteen + '</th></tr>';
                        resultData += '<tr><th>Кол-во парней младше 21 лет:</th><th>' + data.guestsMaleUnderTwentyOne + '</th></tr>';
                        resultData += '<tr><th>Кол-во девушек младше 18 лет: </th><th>' + data.guestsFemaleUnderEighteen + '</th></tr>';
                        resultData += '</table>';
                        $("#result-container-counts").html(resultData)

                        let resultDataTopTenGuests = '<table><tr><td>Топ 10 гостей</td></tr>';
                        $.each(data.topTenGuests, function (index, value) {
                            resultDataTopTenGuests += '<tr><td>' + value.result + '</td></tr>'
                        });
                        resultDataTopTenGuests += '</table>'
                        $("#result-container-topTenGuests").html(resultDataTopTenGuests)

                        let resultDataTopTenAges = '<table><tr><td>Топ 10 возрастов</td></tr>';
                        $.each(data.topTenAges, function (index, value) {
                            resultDataTopTenAges += '<tr><td>' + value.result + '</td></tr>'
                        });
                        resultDataTopTenAges += '</table>'
                        $("#result-container-topTenAges").html(resultDataTopTenAges)
                    }
                });
            });

        </script>
    @endpush
@endsection

