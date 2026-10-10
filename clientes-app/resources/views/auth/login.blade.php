@extends('layouts.app')

@section('titulo', 'Iniciar sesión')

@section('content')
    <h2 class="mb-1">¡Bienvenido de nuevo!</h2>
    <p class="text-muted mb-4">Ingresa tus credenciales para continuar.</p>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label class="form-label fw-medium">Correo electrónico</label>
        <div class="input-icon mb-3 @error('email') has-error @enderror">
            <i class="bi bi-envelope"></i>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="correo@ejemplo.com" required autofocus>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <label class="form-label fw-medium">Contraseña</label>
        <div class="input-icon mb-3 @error('password') has-error @enderror">
            <i class="bi bi-lock"></i>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
            <button type="button" class="toggle-password"><i class="bi bi-eye"></i></button>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Recordarme</label>
            </div>
            <a href="{{ route('password.request') }}" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
        </div>

        <button class="btn btn-primary w-100 py-2 fw-medium">Iniciar sesión <i class="bi bi-arrow-right ms-1"></i></button>
    </form>

    <p class="text-center text-muted mt-4 mb-0">¿No tienes cuenta? <a href="{{ route('register') }}" class="text-decoration-none fw-medium">Regístrate</a></p>
@endsection
