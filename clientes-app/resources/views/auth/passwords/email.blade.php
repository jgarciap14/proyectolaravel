@extends('layouts.app')

@section('titulo', 'Recuperar contraseña')

@section('content')
    <h2 class="mb-1">¿Olvidaste tu contraseña?</h2>
    <p class="text-muted mb-4">Escribe tu correo y te enviaremos un enlace para restablecerla.</p>

    @if (session('status'))
        <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i>{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <label class="form-label fw-medium">Correo electrónico</label>
        <div class="input-icon mb-4 @error('email') has-error @enderror">
            <i class="bi bi-envelope"></i>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="correo@ejemplo.com" required autofocus>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-primary w-100 py-2 fw-medium">Enviar enlace <i class="bi bi-send ms-1"></i></button>
    </form>

    <p class="text-center mt-4 mb-0"><a href="{{ route('login') }}" class="text-decoration-none"><i class="bi bi-arrow-left me-1"></i>Volver al inicio de sesión</a></p>
@endsection
