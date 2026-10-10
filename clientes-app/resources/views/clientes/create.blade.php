@extends('layouts.app')

@section('titulo', 'Clientes')

@section('content')
<div class="container-fluid px-0">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="tarjeta p-4">
                <h1 class="h5 fw-semibold mb-1">Registrar cliente</h1>
                <p class="text-muted small mb-4">Ingresa el nombre y el correo del cliente.</p>

                @if (session('ok'))
                    <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i>{{ session('ok') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('clientes.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-medium" for="nombre">Nombre</label>
                        <div class="input-icon">
                            <i class="bi bi-person"></i>
                            <input class="form-control" id="nombre" name="nombre" type="text" value="{{ old('nombre') }}" placeholder="Juan Pérez" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-medium" for="correo">Correo</label>
                        <div class="input-icon">
                            <i class="bi bi-envelope"></i>
                            <input class="form-control" id="correo" name="correo" type="email" value="{{ old('correo') }}" placeholder="cliente@correo.com" required>
                        </div>
                    </div>

                    <button class="btn btn-primary w-100" type="submit"><i class="bi bi-save me-1"></i> Guardar cliente</button>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="tarjeta">
                <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center p-4">
                    <div>
                        <h2 class="h5 fw-semibold mb-1">Clientes registrados</h2>
                        <small class="text-muted"><span id="contador-clientes">{{ $clientes->count() }}</span> clientes</small>
                    </div>
                    <div class="input-icon">
                        <i class="bi bi-search"></i>
                        <input type="text" id="filtro-clientes" class="form-control" placeholder="Filtrar por nombre o correo">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table tabla-clientes mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clientes as $cliente)
                                <tr data-cliente>
                                    <td class="text-muted">{{ $cliente->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar">{{ mb_strtoupper(mb_substr($cliente->nombre, 0, 1)) }}</div>
                                            <span class="fw-medium">{{ $cliente->nombre }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $cliente->correo }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-5">Aún no hay clientes.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
