<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table="empleados";

    protected $fillable=[
        'nombre',
        'cargo',
        'usuario',
        'contraseña',
        'idTurno'
        
    ];

    public function turno()

        {
        return $this->belongsTo(Turno::class, 'idTurno');
    }

}