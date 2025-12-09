<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = "empleados";

    protected $fillable = [
        'nombre',
        'telefono',
        'correo',
        'cargo',
    ];

    /**
     * Relación: Un empleado tiene muchas ventas
     */
    public function ventas()
    {
        return $this->hasMany(ventas::class, 'idempleado');
    }
}
