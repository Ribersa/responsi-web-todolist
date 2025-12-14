<!doctype html>

@php
    $userTheme = Auth::check() ? Auth::user()->theme : 'light';
    $userLang = Auth::check() ? Auth::user()->language : 'id';
    
    // Set Locale untuk Carbon (Format Tanggal)
    if($userLang == 'id') {
        \Carbon\Carbon::setLocale('id');
    } else {
        \Carbon\Carbon::setLocale('en');
    }
@endphp

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="{{ $userTheme }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ToDoApp') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            /* Default Light Mode Gradient */
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Nunito', sans-serif;
            transition: background 0.5s ease;
        }

        /* Navbar Glassmorphism */
        .navbar {
            background-color: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            
            /* FIX: Agar Dropdown tidak ketutupan elemen lain */
            position: relative; 
            z-index: 1050;
        }

        /* Card / Kotak Konten Modern */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
            
            /* FIX: Agar sudut header mengikuti lengkungan card */
            overflow: hidden; 
        }

        /* Form Input Kustom */
        .form-control, .form-select {
            padding: 12px 15px;
            border-radius: 12px;
        }

        /* Tombol Hover Effect */
        .btn { transition: all 0.3s; }
        .btn:hover { transform: translateY(-2px); }

        /* DARK MODE OVERRIDES */
        [data-bs-theme="dark"] body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%) !important;
            color: #e0e0e0;
        }
        [data-bs-theme="dark"] .navbar {
            background-color: rgba(33, 37, 41, 0.95) !important;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        [data-bs-theme="dark"] .card {
            background-color: #212529;
            border: 1px solid rgba(255,255,255,0.1);
        }
        [data-bs-theme="dark"] .form-control, 
        [data-bs-theme="dark"] .form-select,
        [data-bs-theme="dark"] .input-group-text,
        [data-bs-theme="dark"] .list-group-item {
            background-color: #2c3035;
            border-color: #495057;
            color: #e0e0e0;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                
                <a class="navbar-brand fw-bolder text-primary fs-3" href="{{ url('/') }}">
                    <i class="fa-solid fa-layer-group me-2"></i>ToDo<span class="text-body">App</span>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-primary" href="{{ route('todos.index') }}">
                                    <i class="fa fa-list me-1"></i> Daftar Tugas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-success" href="{{ route('todos.create') }}">
                                    <i class="fa fa-plus-circle me-1"></i> Tambah Tugas
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-primary btn-sm rounded-pill px-4 me-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary btn-sm rounded-pill px-4" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold text-body" href="#" role="button" data-bs-toggle="dropdown">
                                    
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" class="rounded-circle me-2" width="32" height="32" style="object-fit: cover; border: 2px solid #0d6efd;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D6EFD&color=fff&rounded=true&size=32" class="me-2">
                                    @endif
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius: 15px;">
                                    
                                    
                                    <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                        <i class="fa-solid fa-user-pen me-2 text-primary"></i> Edit Profil
                                    </a>

                                    
                                    <a class="dropdown-item py-2" href="{{ route('profile.edit.password') }}">
                                        <i class="fa-solid fa-lock me-2 text-warning"></i> Akun & Keamanan
                                    </a>

                                    
                                    <a class="dropdown-item py-2" href="{{ route('profile.edit.settings') }}">
                                        <i class="fa-solid fa-sliders me-2 text-dark"></i> Pengaturan
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    
                                    <a class="dropdown-item py-2" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-arrow-right-from-bracket me-2 text-danger"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            @yield('content')
        </main>
    </div>
</body>
</html>