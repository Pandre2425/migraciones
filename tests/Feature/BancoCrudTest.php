<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Cuenta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BancoCrudTest extends TestCase
{
    use RefreshDatabase;

    private function clienteData(): array
    {
        return ['nombre' => 'Ana Perez', 'email' => 'ana@example.com', 'telefono' => null, 'direccion' => 'Guatemala'];
    }

    public function test_cliente_crud_and_views(): void
    {
        $this->get('/clientes')->assertOk();
        $this->get('/clientes/create')->assertOk()->assertSee('name="nombre"', false);
        $this->post('/clientes', $this->clienteData())->assertSessionHasNoErrors()->assertRedirect();
        $cliente = Cliente::firstOrFail();
        $this->get('/clientes/'.$cliente->id)->assertOk()->assertSee('Ana Perez');
        $this->get('/clientes/'.$cliente->id.'/edit')->assertOk()->assertSee('Ana Perez');
        $this->put('/clientes/'.$cliente->id, array_replace($this->clienteData(), ['nombre' => 'Ana Lopez']))->assertSessionHasNoErrors()->assertRedirect();
        $this->assertDatabaseHas('cliente', ['id' => $cliente->id, 'nombre' => 'Ana Lopez']);
        $this->delete('/clientes/'.$cliente->id)->assertRedirect('/clientes');
        $this->assertDatabaseMissing('cliente', ['id' => $cliente->id]);
    }

    public function test_cuenta_crud_and_deletion_rules(): void
    {
        $cliente = Cliente::create($this->clienteData());
        $data = ['cliente_id' => $cliente->id, 'numero_cuenta' => '00001234', 'tipo' => 'ahorro', 'saldo' => '12.50'];
        $this->get('/cuentas')->assertOk();
        $this->get('/cuentas/create')->assertOk()->assertSee('name="numero_cuenta"', false);
        $this->post('/cuentas', $data)->assertSessionHasNoErrors()->assertRedirect();
        $cuenta = Cuenta::firstOrFail();
        $this->assertSame('12.50', $cuenta->saldo);
        $this->get('/cuentas/'.$cuenta->id)->assertOk()->assertSee('00001234');
        $this->get('/cuentas/'.$cuenta->id.'/edit')->assertOk();
        $this->delete('/clientes/'.$cliente->id)->assertSessionHasErrors('cliente');
        $this->delete('/cuentas/'.$cuenta->id)->assertSessionHasErrors('saldo');
        $this->assertDatabaseHas('cuenta', ['id' => $cuenta->id]);
        $this->put('/cuentas/'.$cuenta->id, array_replace($data, ['saldo' => '0.00', 'tipo' => 'monetaria']))->assertSessionHasNoErrors()->assertRedirect();
        $this->assertDatabaseHas('cuenta', ['id' => $cuenta->id, 'tipo' => 'monetaria', 'saldo' => 0]);
        $this->delete('/cuentas/'.$cuenta->id)->assertRedirect('/cuentas');
        $this->assertDatabaseMissing('cuenta', ['id' => $cuenta->id]);
    }

    public function test_invalid_input_is_rejected(): void
    {
        $this->post('/clientes', ['email' => 'invalid'])->assertSessionHasErrors(['nombre', 'email', 'direccion']);
        $this->get('/cuentas/create')->assertOk()->assertSee('Primero debes registrar un cliente.');
        $cliente = Cliente::create($this->clienteData());
        $data = ['cliente_id' => $cliente->id, 'numero_cuenta' => '123', 'tipo' => 'ahorro', 'saldo' => '0.00'];
        Cuenta::create($data);
        $this->post('/cuentas', $data)->assertSessionHasErrors('numero_cuenta');
        $this->post('/cuentas', array_replace($data, ['numero_cuenta' => '456', 'cliente_id' => 999, 'saldo' => '-1']))->assertSessionHasErrors(['cliente_id', 'saldo']);
        $this->post('/cuentas', array_replace($data, ['numero_cuenta' => '456', 'saldo' => '1.123']))->assertSessionHasErrors('saldo');
        $this->get('/clientes/999')->assertNotFound();
        $this->get('/cuentas/999')->assertNotFound();
    }
}
