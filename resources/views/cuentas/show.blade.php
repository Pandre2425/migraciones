@extends('layout.app')
@section('title', 'Detalle de cuenta')
@section('content')
<h1>Cuenta {{ $cuenta->numero_cuenta }}</h1>
<section><dl><dt>Titular</dt><dd><a href="{{ route('clientes.show', $cuenta->cliente) }}">{{ $cuenta->cliente->nombre }}</a></dd><dt>Tipo</dt><dd>{{ $cuenta->tipo }}</dd><dt>Saldo</dt><dd>{{ $cuenta->saldo }}</dd><dt>Fecha de creación</dt><dd>{{ $cuenta->created_at->format('d/m/Y H:i') }}</dd></dl>
<div class="actions"><a class="button" href="{{ route('cuentas.edit', $cuenta) }}">Editar cuenta</a><form action="{{ route('cuentas.destroy', $cuenta) }}" method="POST" onsubmit="return confirm('¿Eliminar esta cuenta?')">@csrf @method('DELETE')<button class="danger">Eliminar cuenta</button></form><a href="{{ route('cuentas.index') }}">Volver</a></div>
<small>Solo se pueden eliminar cuentas con saldo cero.</small></section>
@endsection
