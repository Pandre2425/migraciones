@extends('layout.app')
@section('title', 'Inicio')
@section('content')
<h1>Administración bancaria</h1>
<p>Gestiona los clientes y sus cuentas desde la plataforma interna.</p>
<div class="grid">
<section><h2>Clientes</h2><p>Consulta y actualiza los datos de contacto de tus clientes.</p><a class="button" href="{{ route('clientes.index') }}">Administrar clientes</a></section>
<section><h2>Cuentas</h2><p>Registra cuentas y consulta sus titulares, tipos y saldos.</p><a class="button" href="{{ route('cuentas.index') }}">Administrar cuentas</a></section>
</div>
@endsection
