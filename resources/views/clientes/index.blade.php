@extends('layout.app')
@section('title', 'Clientes')
@section('content')
<h1>Clientes</h1>
<p><a class="button" href="{{ route('clientes.create') }}">Nuevo cliente</a></p>
<section class="table-wrap"><table><thead><tr><th>Nombre</th><th>Correo electrónico</th><th>Teléfono</th><th>Cuentas</th><th>Acciones</th></tr></thead><tbody>
@forelse($clientes as $cliente)
<tr><td>{{ $cliente->nombre }}</td><td>{{ $cliente->email }}</td><td>{{ $cliente->telefono ?: '—' }}</td><td>{{ $cliente->cuentas_count }}</td><td><a href="{{ route('clientes.show', $cliente) }}">Ver</a> · <a href="{{ route('clientes.edit', $cliente) }}">Editar</a></td></tr>
@empty<tr><td colspan="5">Todavía no hay clientes registrados.</td></tr>@endforelse
</tbody></table>{{ $clientes->links() }}</section>
@endsection
