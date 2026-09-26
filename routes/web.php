<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CuentaController;

Route::get('/', function () {
    return view('inicio');
});

Route::resource('clientes', ClienteController::class);
Route::resource('cuentas', CuentaController::class);
