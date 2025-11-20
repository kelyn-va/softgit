<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ventas extends Model
{
    public $table = "ventas";
    protected $fillable = [
        'total',
        'metodo_pago',
        'idempleado',
        'idproducto'
    ];

   

   public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idempleado');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idproducto');
    }
}
