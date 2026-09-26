<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cuenta;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CuentaController extends Controller
{
    public function index()
    {
        return view('cuentas.index', ['cuentas' => Cuenta::with('cliente')->latest('id')->paginate(10)]);
    }

    public function create()
    {
        return view('cuentas.create', ['cuenta' => new Cuenta(['saldo' => '0.00']), 'clientes' => Cliente::orderBy('nombre')->get()]);
    }

    public function store(Request $request)
    {
        $cuenta = Cuenta::create($this->validated($request));

        return redirect()->route('cuentas.show', $cuenta)->with('success', 'Cuenta creada correctamente.');
    }

    public function show(Cuenta $cuenta)
    {
        return view('cuentas.show', ['cuenta' => $cuenta->load('cliente')]);
    }

    public function edit(Cuenta $cuenta)
    {
        return view('cuentas.edit', ['cuenta' => $cuenta, 'clientes' => Cliente::orderBy('nombre')->get()]);
    }

    public function update(Request $request, Cuenta $cuenta)
    {
        $cuenta->update($this->validated($request, $cuenta));

        return redirect()->route('cuentas.show', $cuenta)->with('success', 'Cuenta actualizada correctamente.');
    }

    public function destroy(Cuenta $cuenta)
    {
        if ($cuenta->saldo !== '0.00') {
            return back()->withErrors(['saldo' => 'Solo se pueden eliminar cuentas con saldo cero.']);
        }

        $cuenta->delete();

        return redirect()->route('cuentas.index')->with('success', 'Cuenta eliminada correctamente.');
    }

    private function validated(Request $request, ?Cuenta $cuenta = null): array
    {
        return $request->validate([
            'cliente_id' => ['required', 'integer', 'exists:cliente,id'],
            'numero_cuenta' => ['required', 'string', 'max:20', Rule::unique('cuenta', 'numero_cuenta')->ignore($cuenta)],
            'tipo' => ['required', 'string', 'max:20'],
            'saldo' => ['required', 'numeric', 'decimal:0,2', 'min:0', 'max:9999999999.99'],
        ]);
    }
}
