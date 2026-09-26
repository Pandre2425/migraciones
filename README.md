# migraciones — banco_gt

Proyecto Laravel 12 para administrar clientes y cuentas con MySQL.

## Funciones

- CRUD de clientes y cuentas con vistas Blade.
- Relación entre clientes y cuentas, validación y números de cuenta únicos.
- Impide eliminar clientes con cuentas o cuentas con saldo distinto de cero.

## Instalación local

Requiere PHP 8.2 o superior, Composer y MySQL.

1. Ejecuta `composer install`.
2. Copia `.env.example` a `.env` y configura las credenciales MySQL. El puerto usado en este entorno XAMPP es 3307.
3. Crea una base vacía llamada `banco_gt_db` en phpMyAdmin.
4. Ejecuta `php artisan key:generate`.
5. Ejecuta `php artisan migrate`.
6. Ejecuta `php artisan serve` y abre http://127.0.0.1:8000.

Las migraciones crean las tablas; no es necesario crearlas previamente con SQL.
Las vistas actuales no requieren compilar recursos con npm.

## Pruebas

Ejecuta `php artisan test`. Las pruebas usan SQLite en memoria.

## Alcance

Proyecto local académico, sin inicio de sesión ni historial de depósitos o retiros.
El archivo `.env`, las dependencias, los logs y los datos locales no se incluyen en Git.
