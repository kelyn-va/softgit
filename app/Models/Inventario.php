<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table="inventario";

    protected $fillable=[
        'Cantidad',
        'FechaActualizacion'
    ];

public function producto()
{
    return $this->belongsTo(Producto::class, 'idproducto');
}
}
