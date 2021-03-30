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
        <nav class="navbar navbar-expand-sm navbar-light bg-gsbule shadow-sm">
          <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="/images/gb_logo-13.svg" style="height: 40px;" alt="G'sBook">
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
                       @else
                           {{-- ログイン済み --}}
                           <li class="nav-item dropdown ml-2">
                               {{-- ログイン情報 --}}
                               <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   @if (!empty(Auth::user()->avatar_file_name))
                                       <img src="/storage/avatars/{{Auth::user()->avatar_file_name}}" class="rounded-circle" style="object-fit: cover; width: 35px; height: 35px;">
                                   @else
                                       <img src="/images/avatar_default.png" class="rounded-circle" style="object-fit: cover; width: 35px; height: 35px;">
                                   @endif
                                   {{ Auth::user()->name }}さん こんにちは<span class="caret"></span>
                               </a>
                               {{-- ドロップダウンメニュー --}}
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                     @if(Auth::user()->role == 2)
                                     <a class="dropdown-item" href="{{ route('admin') }}">
                                         <i class="far fa-address-card text-left" style="width: 30px"></i>{{ __('Admin') }}
                                     </a>
                                     @endif
                                     <a class="dropdown-item" href="{{ route('posts.index') }}">
                                         <i class="far fa-comment-alt text-left" style="width: 30px"></i>{{ __('Post') }}
                                     </a>
                                     <a class="dropdown-item" href="{{ route('mypage.edit-profile') }}">
                                         <i class="far fa-address-card text-left" style="width: 30px"></i>{{ __('Profile edit') }}
                                     </a>
                                     <a class="dropdown-item" href="{{ route('password.form') }}">
                                       <i class="fas fa-unlock-alt text-left" style="width: 30px"></i>{{ __('Change Password') }}
                                     </a>
                                     <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">
                                         <i class="fas fa-sign-out-alt text-left" style="width: 30px"></i>ログアウト
                                     </a>
         
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                         @csrf
                                     </form>
                                 </div>
                           </li>
                       @endguest
                   </ul>
               </div>
           </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('mainscript')
</body>
</html>
