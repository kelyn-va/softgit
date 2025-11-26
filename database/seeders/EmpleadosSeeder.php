<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;

class EmpleadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Empleado::create(['nombre' => 'Karen López', 'cargo' => 'Cajera', 'usuario' => 'klopez', 'contraseña' => ('123456')]);
        Empleado::create(['nombre' => 'Carlos Gómez', 'cargo' => 'Vendedor', 'usuario' => 'cgomez', 'contraseña' => ('123456')]);
        Empleado::create(['nombre' => 'María Torres', 'cargo' => 'Supervisora', 'usuario' => 'mtorres', 'contraseña' => ('123456')]);   
        Empleado::create(['nombre' => 'Juan Pérez', 'cargo' => 'Administrador', 'usuario' => 'jperez', 'contraseña' => ('123456')]);
        
        
}


}
