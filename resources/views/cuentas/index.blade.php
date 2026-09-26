@extends('layout.app')
@section('title', 'Cuentas')
@section('content')
<h1>Cuentas</h1>
<p><a class="button" href="{{ route('cuentas.create') }}">Nueva cuenta</a></p>
<section class="table-wrap"><table><thead><tr><th>Número de cuenta</th><th>Cliente</th><th>Tipo</th><th>Saldo</th><th>Acciones</th></tr></thead><tbody>
@forelse($cuentas as $cuenta)
<tr><td>{{ $cuenta->numero_cuenta }}</td><td>{{ $cuenta->cliente->nombre }}</td><td>{{ $cuenta->tipo }}</td><td>{{ $cuenta->saldo }}</td><td><a href="{{ route('cuentas.show', $cuenta) }}">Ver</a> · <a href="{{ route('cuentas.edit', $cuenta) }}">Editar</a></td></tr>
@empty<tr><td colspan="5">Todavía no hay cuentas registradas.</td></tr>@endforelse
</tbody></table>{{ $cuentas->links() }}</section>
@endsection
