<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $fillable = [
        'precioCompra',
        'precioVenta',
        'Total',
        'metodoPago',
        'Cantidad',
        'idproveedor'
    ];

     public function compra()
    {
        return $this->belongsTo(Compra::class, 'idcompra');
    }


    public function compras()
    {
        return $this->hasMany(Compra::class, 'idproveedor');
    }

    public function proveedores()
    {
        return $this->belongsTo(Proveedor::class, 'idproveedor');


    }

    public function productos()
    {
        return $this->belongsTo(Producto::class, 'idproducto');
    }



}
