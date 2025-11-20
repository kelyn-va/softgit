<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
     protected $table="productos";

    protected $fillable=[
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'codigoBarras',
        'idCategoria',
        'idProveedor'
    ];

    /**
     * Relación: Un producto pertenece a una categoría
     */
    public function categoria()
    {
        return $this->belongsTo(Categorias::class,'idCategoria');
    }

    /**
     * Relación: Un producto pertenece a un proveedor
     */
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class,'idProveedor');
    }

    /**
     * Relación: Un producto tiene un inventario
     */
    public function inventario()
    {
        return $this->hasOne(Inventario::class,'idProducto');
    }

    /**
     * Relación: Un producto aparece en muchos detalles de venta
     */
    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class,'idProducto');
    }

}