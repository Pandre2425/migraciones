@if($clientes->isEmpty())
<section><p>Primero debes registrar un cliente.</p><a class="button" href="{{ route('clientes.create') }}">Nuevo cliente</a></section>
@else
<section><form class="editor" method="POST" action="{{ $cuenta->exists ? route('cuentas.update', $cuenta) : route('cuentas.store') }}">
@csrf
@if($cuenta->exists) @method('PUT') @endif
<label for="cliente_id">Cliente</label><select id="cliente_id" name="cliente_id" required><option value="">Selecciona un cliente</option>@foreach($clientes as $cliente)<option value="{{ $cliente->id }}" @selected(old('cliente_id', $cuenta->cliente_id) == $cliente->id)>{{ $cliente->nombre }} ({{ $cliente->email }})</option>@endforeach</select>
<label for="numero_cuenta">Número de cuenta</label><input id="numero_cuenta" name="numero_cuenta" maxlength="20" required value="{{ old('numero_cuenta', $cuenta->numero_cuenta) }}">
<label for="tipo">Tipo de cuenta</label><input id="tipo" name="tipo" list="tipos" maxlength="20" required value="{{ old('tipo', $cuenta->tipo) }}"><datalist id="tipos"><option value="ahorro"><option value="monetaria"></datalist>
<label for="saldo">Saldo</label><input id="saldo" name="saldo" type="number" min="0" max="9999999999.99" step="0.01" required value="{{ old('saldo', $cuenta->saldo) }}">
<div class="actions"><button type="submit">Guardar cuenta</button><a href="{{ route('cuentas.index') }}">Cancelar</a></div>
</form></section>
@endif
