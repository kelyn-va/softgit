<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    protected $table = 'devolucions';

    protected $fillable = [
        'idventa',
        'cantidad',
        'motivo',
        'fecha_devolucion',
        'estado'
    ];

    protected $casts = [
        'fecha_devolucion' => 'datetime',
    ];

    /**
     * Relación: Una devolución pertenece a una venta
     */
    public function venta()
    {
        return $this->belongsTo(ventas::class, 'idventa');
    }
}
