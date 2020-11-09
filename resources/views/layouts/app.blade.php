<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">

</head>
<body>
<div class="main">
    <div class="main-overlay"></div>
    <div class="header">
        <div class="logo">
            <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt="logo"></a>
        </div>
        <div class="menu">
            <ul>
                @guest
                    <li><a class="menu-link" href="{{ route('login') }}">Войти</a></li>
                    <li><a class="menu-link" href="{{ route('register') }}">Зарегистрироваться</a></li>
                @else
                    <li><a class="menu-link" href="{{ route('guestbook.guests.index') }}">Гости</a></li>
                    <li><a class="menu-link" href="{{ route('guestbook.visits.index') }}">Визиты</a></li>
                    <li><a class="menu-link" href="/statistic">Статистика</a></li>
                    <li>
                        <a class="menu-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Выйти
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <div class="footer">
        <p>Надпись не имеет смысла</p>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- App scripts -->
<script type="text/javascript" charset="utf-8"
        src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
@stack('scripts')
</body>
</html>


