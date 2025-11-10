<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table= "clientes";
    protected $fillable =[
        'Nombre',
        'Telefono',
        'Email',
        'Direccion' 
    ];
    public function ventas()
    {
        return $this->hasMany(Ventas::class, 'idCliente');
    }
}