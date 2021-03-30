<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
 
     <link rel="shortcut icon" href="/images/logo.ico">
     <link rel="icon" type="image/x-icon" href="/images/gb_logo-02.svg">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm">
          <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="/images/gb_logo-12.svg" style="height: 40px;" alt="G'sBook">
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
               <div class="collapse navbar-collapse justify-contnt-end" id="navbarSupportedContent">
                   <ul class="navbar-nav ml-auto">
                       @guest
                           {{-- 非ログイン --}}
                           <!--<li class="nav-item">-->
                           <!--    <a class="btn btn-secondary mt-1 ml-2 mb-1" href="{{ route('register') }}" role="button">会員登録</a>-->
                           <!--</li>-->
                           <li class="nav-item">
                               <a class="btn btn-outline-info mt-1 ml-2 mb-1" href="{{ route('login') }}" role="button">ログイン</a>
                           </li>
                       @endguest
                   </ul>
               </div>
           </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
