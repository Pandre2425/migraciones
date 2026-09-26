<section><form class="editor" method="POST" action="{{ $cliente->exists ? route('clientes.update', $cliente) : route('clientes.store') }}">
@csrf
@if($cliente->exists) @method('PUT') @endif
<label for="nombre">Nombre</label><input id="nombre" name="nombre" maxlength="100" required value="{{ old('nombre', $cliente->nombre) }}">
<label for="email">Correo electrónico</label><input id="email" name="email" type="email" maxlength="150" required value="{{ old('email', $cliente->email) }}">
<label for="telefono">Teléfono (opcional)</label><input id="telefono" name="telefono" type="tel" maxlength="200" value="{{ old('telefono', $cliente->telefono) }}">
<label for="direccion">Dirección</label><input id="direccion" name="direccion" maxlength="255" required value="{{ old('direccion', $cliente->direccion) }}">
<div class="actions"><button type="submit">Guardar cliente</button><a href="{{ route('clientes.index') }}">Cancelar</a></div>
</form></section>
