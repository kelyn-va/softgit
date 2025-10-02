<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inventario extends Model
{
    protected $table="Inventario";

    protected $fillable=[
        'Cantidad',
        'FechaActualizacion'
    ];
}
