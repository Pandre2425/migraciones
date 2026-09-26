<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $table = 'cliente';

    protected $fillable = ['nombre', 'email', 'telefono', 'direccion'];

    public function cuentas(): HasMany
    {
        return $this->hasMany(Cuenta::class, 'cliente_id');
    }
}
