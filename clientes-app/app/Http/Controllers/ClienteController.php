<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function create()
    {
        $clientes = Cliente::latest()->get();

        return view('clientes.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'email', 'max:255', 'unique:clientes,correo'],
        ]);

        $cliente = Cliente::create($datos);

        return redirect()
            ->route('clientes.create')
            ->with('ok', 'Cliente guardado: ' . $cliente->nombre . ' (' . $cliente->correo . ')');
    }
}
