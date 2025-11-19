<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pagos extends Model
{
    protected $table = 'pagos';

    protected $fillable = [
        'monto',
        'idventa',
        'idmetodopagos',
    ];

  public function venta()
    {
        return $this->belongsTo(ventas::class, 'idventa');
    }

    public function metodopagos()
    {
        return $this->belongsTo(metodoPago::class, 'idmetodopagos');
    }
}
