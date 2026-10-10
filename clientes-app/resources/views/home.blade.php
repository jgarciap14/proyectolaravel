@extends('layouts.app')

@section('titulo', 'Inicio')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="tarjeta stat">
                <div class="icono"><i class="bi bi-person-check"></i></div>
                <div>
                    <small class="text-muted">Sesión iniciada como</small>
                    <h3 class="h5">{{ Auth::user()->name }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tarjeta stat">
                <div class="icono"><i class="bi bi-people"></i></div>
                <div>
                    <small class="text-muted">Clientes registrados</small>
                    <h3>{{ $total }}</h3>
                </div>
                <a href="{{ route('clientes.create') }}" class="btn btn-primary ms-auto">Ir a clientes</a>
            </div>
        </div>
    </div>

    <div class="tarjeta">
        <div class="p-4 pb-3">
            <h6 class="fw-semibold mb-0">Últimos clientes registrados</h6>
        </div>
        <div class="table-responsive">
            <table class="table tabla-clientes mb-0">
                <thead>
                    <tr><th>Nombre</th><th>Correo</th><th>Registrado</th></tr>
                </thead>
                <tbody>
                    @forelse ($recientes as $cliente)
                        <tr>
                            <td class="fw-medium">{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->correo }}</td>
                            <td class="text-muted">{{ $cliente->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted py-4">Aún no hay clientes.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
