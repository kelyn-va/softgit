<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $acciones = [
            'Apertura de caja',
            'Cierre de caja',
            'Registro de venta',
            'Cancelación de venta',
            'Actualización de producto',
            'Ingreso de proveedor',
            'Eliminación de registro',
            'Generación de reporte',
        ];

        for ($i = 0; $i < 20; $i++) {

            DB::table('auditorias')->insert([
                'Accion' => $acciones[array_rand($acciones)],
                'fecha' => now()->subDays(rand(0, 30))->setTime(rand(7, 20), rand(0, 59), 0),
                'cierreCaja' => rand(100000, 500000) / 10, // 10,000 a 50,000 aprox
                'idEmpleado' => rand(1, 4), // Empleados del 1 al 30
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
