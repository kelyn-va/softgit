<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table="inventario";

    protected $fillable=[
        'idProducto',
        'cantidad',
        'cantidad_minima',
        'fecha_actualizacion',
        'nota'
    ];

    protected $casts = [
        'fecha_actualizacion' => 'datetime',
    ];

    /**
     * Relación: Un inventario pertenece a un producto
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }
}
