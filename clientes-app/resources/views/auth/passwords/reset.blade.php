@extends('layouts.app')

@section('titulo', 'Nueva contraseña')

@section('content')
    <h2 class="mb-1">Restablecer contraseña</h2>
    <p class="text-muted mb-4">Crea una nueva contraseña para tu cuenta.</p>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <label class="form-label fw-medium">Correo electrónico</label>
        <div class="input-icon mb-3 @error('email') has-error @enderror">
            <i class="bi bi-envelope"></i>
            <input type="email" name="email" value="{{ $email ?? old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <label class="form-label fw-medium">Nueva contraseña</label>
        <div class="input-icon mb-2 @error('password') has-error @enderror">
            <i class="bi bi-lock"></i>
            <input type="password" name="password" data-fuerza class="form-control @error('password') is-invalid @enderror" placeholder="Mínimo 8 caracteres" required autofocus>
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
            <input type="password" name="password_confirmation" class="form-control" required>
            <button type="button" class="toggle-password"><i class="bi bi-eye"></i></button>
        </div>

        <button class="btn btn-primary w-100 py-2 fw-medium">Guardar contraseña <i class="bi bi-check2 ms-1"></i></button>
    </form>
@endsection
