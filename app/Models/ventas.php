<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ventas extends Model
{
    public $table = "ventas";
    protected $fillable = [
        'fecha',
        'total',
        'idCliente',
        'idempleado'

    ];

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'idCliente');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idempleado');
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'idventa');
    }
}
