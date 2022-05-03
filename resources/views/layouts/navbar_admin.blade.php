<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DeliveBoo</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/faviconV2.ico') }}">
    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="main-navbar navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!--<a class="navbar-brand" href="{{ url('/') }}">
                    HomePage
                </a>-->
                <a class="navbar-hover d-none d-xs-none d-sm-none d-md-block d-xl-block navbar-brand " href="{{ url('/') }}">
                    Homepage
                </a>

                <a class="navbar-hover d-none d-xs-none d-sm-none d-md-block d-xl-block navbar-brand " href="{{ url('/admin/recap') }}">
                    Profilo
                </a>

                <a class="navbar-hover d-none d-xs-none d-sm-none d-md-block d-xl-block navbar-brand " href="{{ url('/admin/types') }}">
                    Categorie
                </a>
                
                <a class="navbar-hover d-none d-xs-none d-sm-none d-md-block d-xl-block navbar-brand " href="{{ url('/admin/plate') }}">
                    Piatti
                </a>

                <a class="navbar-hover d-none d-xs-none d-sm-none d-md-block d-xl-block navbar-brand " href="{{ url('/admin/order') }}">
                    Ordini In Arrivo
                </a>
                
                <a class="navbar-hover d-none d-xs-none d-sm-none d-md-block d-xl-block navbar-brand " href="{{ url('/admin/statistics') }}">
                    Statistiche
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <a class="d-sm-block d-md-none d-lg-none navbar-link " href="{{ url('/') }}">
                            Homepage
                        </a>

                        <a class="d-sm-block d-md-none d-lg-none navbar-link " href="{{ url('/admin/recap') }}">
                            Profilo
                        </a>
        
                        <a class="d-sm-block d-md-none d-lg-none navbar-link " href="{{ url('/admin/types') }}">
                            Categorie
                        </a>
                        
                        <a class="d-sm-block d-md-none d-lg-none navbar-link " href="{{ url('/admin/plate') }}">
                            Piatti
                        </a>

                        <a class="d-sm-block d-md-none d-lg-none navbar-link " href="{{ url('/admin/order') }}">
                            Ordini in arrivo
                        </a>

                        <a class="d-sm-block d-md-none d-lg-none navbar-link " href="{{ url('/admin/statistics') }}">
                            Statistiche
                        </a>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Esci') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="space-after-navbar"></div> <!-- css in globals.scss -->

        <main class="">
            <div class="bg-effect-layout"></div>
            @yield('content')
        </main>
    </div>
</body>
</html>
<script>
    let count = 0;
    let start = 0;
    let types = document.getElementsByClassName('type-button-all');
    function countType(startUp , check){
        start = startUp;

        if(start >= 4){
            for (let i = 0; i < types.length; i++){ 
                types[i].checked = false;
                types[i].setAttribute("disabled", "disabled");
                types[i].className += " are-disabled";
            }
            return;
        }

        if(check.checked == true)
            count ++;
        else
            count --;

        if(count < 0)
            count = 0;

        if(count+start >= 4){
            for (let i = 0; i < types.length; i++) 
                if(types[i].checked == false){
                    types[i].setAttribute("disabled", "disabled");
                    types[i].className += " are-disabled";
                }
        }else
            for (let i = 0; i < types.length; i++){ 
                types[i].removeAttribute("disabled");
                types[i].classList.remove("are-disabled");
            }
    }
</script>

<style>
    
</style>