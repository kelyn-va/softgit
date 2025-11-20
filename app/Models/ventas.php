<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ventas extends Model
{
    public $table = "ventas";
    protected $fillable = [
        'fecha',
        'total',
        'cliente_nombre',
        'cliente_telefono',
        'cliente_email',
        'idempleado'
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    /**
     * Relación: Una venta pertenece a un empleado
     */
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idempleado');
    }

    /**
     * Relación: Una venta tiene muchos detalles
     */
    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'idventa');
    }

    /**
     * Relación: Una venta puede tener devoluciones
     */
    public function devoluciones()
    {
        return $this->hasMany(Devolucion::class, 'idventa');
    }
}
