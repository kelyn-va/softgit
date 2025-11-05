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
        'idproveedor',
        'idInventario'
        
    ];

    public function categoria()
    {
        return $this->belongsTo(Categorias::class,'idCategoria');
    }


    public function proveedor()
    {
        return $this->belongsTo(proveedor::class,'idProveeedor');
    } 


    public function inventario()
    {
        return $this->belongsTo(Inventario::class,'idInventario');
    }
        
    }