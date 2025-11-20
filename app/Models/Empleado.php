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

    /**
     * Relación: Un empleado pertenece a un turno
     */
    public function turno()
    {
        return $this->belongsTo(Turno::class, 'idTurno');
    }

    /**
     * Relación: Un empleado tiene muchas ventas
     */
    public function ventas()
    {
        return $this->hasMany(ventas::class, 'idempleado');
    }





}