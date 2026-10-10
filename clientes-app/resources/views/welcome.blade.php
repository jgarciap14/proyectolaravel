@extends('layouts.app')

@section('titulo', 'Bienvenido')

@section('content')
    <h2 class="mb-1">Bienvenido</h2>
    <p class="text-muted mb-4">Sistema de gestión de clientes desarrollado con Laravel.</p>

    @auth
        <a href="{{ route('home') }}" class="btn btn-primary w-100 py-2">Ir al inicio</a>
    @else
        <a href="{{ route('login') }}" class="btn btn-primary w-100 py-2 mb-3">Iniciar sesión</a>
        <a href="{{ route('register') }}" class="btn btn-outline-primary w-100 py-2">Crear cuenta</a>
    @endauth
@endsection
