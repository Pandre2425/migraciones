<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return view('clientes.index', ['clientes' => Cliente::withCount('cuentas')->latest('id')->paginate(10)]);
    }

    public function create()
    {
        return view('clientes.create', ['cliente' => new Cliente]);
    }

    public function store(Request $request)
    {
        $cliente = Cliente::create($this->validated($request));

        return redirect()->route('clientes.show', $cliente)->with('success', 'Cliente creado correctamente.');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', ['cliente' => $cliente->load('cuentas')]);
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $cliente->update($this->validated($request));

        return redirect()->route('clientes.show', $cliente)->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        if ($cliente->cuentas()->exists()) {
            return back()->withErrors(['cliente' => 'No se puede eliminar un cliente que tiene cuentas asociadas.']);
        }

        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'telefono' => ['nullable', 'string', 'max:200'],
            'direccion' => ['required', 'string', 'max:255'],
        ]);
    }
}
