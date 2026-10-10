<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Inicio') | {{ config('app.name') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        @auth
            <aside class="sidebar">
                <a href="{{ route('home') }}" class="marca"><i class="bi bi-person-vcard"></i> ClientesApp</a>

                <div class="titulo">Menú</div>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="bi bi-grid"></i> Inicio</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}" href="{{ route('clientes.create') }}"><i class="bi bi-people"></i> Clientes</a>
                    </li>
                    @endauth
                </ul>
            </aside>

            <div class="contenido">
                <header class="topbar">
                    <div class="d-flex align-items-center gap-3">
                        <button id="btn-menu" class="btn btn-light d-lg-none"><i class="bi bi-list"></i></button>
                        <h5 class="mb-0 fw-semibold">@yield('titulo')</h5>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center gap-2 text-decoration-none text-dark" data-bs-toggle="dropdown">
                            <div class="avatar">{{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}</div>
                            <div class="d-none d-sm-block lh-sm">
                                <div class="fw-semibold">{{ Auth::user()->name }}</div>
                                <small class="text-muted">{{ Auth::user()->email }}</small>
                            </div>
                            <i class="bi bi-chevron-down small"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </header>

                <main class="p-4">
                    @yield('content')
                </main>
            </div>
        @else
            <div class="auth-wrapper">
                <div class="auth-hero">
                    <div style="max-width: 480px;">
                        <h1 class="mb-3">Gestión de Clientes</h1>
                        <p class="mb-5 opacity-75">Administra la información de tus clientes de forma rápida, segura y ordenada.</p>
                        <div class="feature"><i class="bi bi-shield-lock"></i> Acceso seguro con autenticación</div>
                        <div class="feature"><i class="bi bi-person-plus"></i> Registro de clientes</div>
                        <div class="feature"><i class="bi bi-table"></i> Listado de clientes registrados</div>
                        <div class="feature"><i class="bi bi-phone"></i> Diseño adaptable a cualquier dispositivo</div>
                    </div>
                </div>
                <main class="auth-form">
                    <div class="logo"><i class="bi bi-person-vcard"></i></div>
                    @yield('content')
                </main>
            </div>
        @endauth
    </div>
</body>
</html>
