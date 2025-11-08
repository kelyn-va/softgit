<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class metodoPago extends Model
{
    public $table = 'metodo_pagos';
    protected $fillable = [
        'descripcion'
    ];
}
