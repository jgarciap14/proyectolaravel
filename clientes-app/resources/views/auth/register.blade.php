@extends('layouts.app')

@section('titulo', 'Registro')

@section('content')
    <h2 class="mb-1">Crear cuenta</h2>
    <p class="text-muted mb-4">Completa el formulario para registrarte.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label class="form-label fw-medium">Nombre completo</label>
        <div class="input-icon mb-3 @error('name') has-error @enderror">
            <i class="bi bi-person"></i>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Juan Pérez" required autofocus>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <label class="form-label fw-medium">Correo electrónico</label>
        <div class="input-icon mb-3 @error('email') has-error @enderror">
            <i class="bi bi-envelope"></i>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="correo@ejemplo.com" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <label class="form-label fw-medium">Contraseña</label>
        <div class="input-icon mb-2 @error('password') has-error @enderror">
            <i class="bi bi-lock"></i>
            <input type="password" name="password" data-fuerza class="form-control @error('password') is-invalid @enderror" placeholder="Mínimo 8 caracteres" required>
            <button type="button" class="toggle-password"><i class="bi bi-eye"></i></button>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="d-flex align-items-center gap-2 mb-3">
            <div class="fuerza flex-grow-1"><div></div></div>
            <small id="fuerza-texto" class="text-muted" style="width: 70px;"></small>
        </div>

        <label class="form-label fw-medium">Confirmar contraseña</label>
        <div class="input-icon mb-4">
            <i class="bi bi-lock-fill"></i>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Repite la contraseña" required>
            <button type="button" class="toggle-password"><i class="bi bi-eye"></i></button>
        </div>

        <button class="btn btn-primary w-100 py-2 fw-medium">Registrarme <i class="bi bi-person-check ms-1"></i></button>
    </form>

    <p class="text-center text-muted mt-4 mb-0">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-decoration-none fw-medium">Inicia sesión</a></p>
@endsection
