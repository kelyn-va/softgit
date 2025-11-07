<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table= "auditorias";
    protected $fillable =[
        'Accion',
        'fecha',
        'cierreCaja',
        'idEmpleado'

    ];
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado');
    }
}
