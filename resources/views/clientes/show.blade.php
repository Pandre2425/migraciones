@extends('layout.app')
@section('title', 'Detalle del cliente')
@section('content')
<h1>{{ $cliente->nombre }}</h1>
<section><dl><dt>Correo electrónico</dt><dd>{{ $cliente->email }}</dd><dt>Teléfono</dt><dd>{{ $cliente->telefono ?: 'No registrado' }}</dd><dt>Dirección</dt><dd>{{ $cliente->direccion }}</dd></dl>
<div class="actions"><a class="button" href="{{ route('clientes.edit', $cliente) }}">Editar cliente</a><form action="{{ route('clientes.destroy', $cliente) }}" method="POST" onsubmit="return confirm('¿Eliminar este cliente?')">@csrf @method('DELETE')<button class="danger">Eliminar cliente</button></form><a href="{{ route('clientes.index') }}">Volver</a></div></section>
<section><h2>Cuentas del cliente</h2>
@forelse($cliente->cuentas as $cuenta)
<p><a href="{{ route('cuentas.show', $cuenta) }}">{{ $cuenta->numero_cuenta }}</a> · {{ $cuenta->tipo }} · Saldo: {{ $cuenta->saldo }}</p>
@empty<p>Este cliente todavía no tiene cuentas.</p>@endforelse
<a href="{{ route('cuentas.create') }}">Crear una cuenta</a>
</section>
@endsection
