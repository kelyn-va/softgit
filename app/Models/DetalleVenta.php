<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    public $timestamps = false;
    protected $table = 'detalle_ventas';
    protected $fillable = [
        'cantidad',
        'precio_unitario',
        'subtotal',
        'idventa',
        'idProducto'
    ];

    public function venta()
    {
        return $this->belongsTo(ventas::class, 'idventa');
    }

    public  function producto()
    {
        return $this->belongsTo(producto::class, 'idProducto');
    }
}
