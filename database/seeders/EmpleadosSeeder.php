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
        Empleado::create(['nombre' => 'Karen López', 'cargo' => 'Cajera', 'usuario' => 'klopez', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'Carlos Gómez', 'cargo' => 'Vendedor', 'usuario' => 'cgomez', 'contraseña' => ('123456'), 'idTurno' => 2]);
        Empleado::create(['nombre' => 'María Torres', 'cargo' => 'Supervisora', 'usuario' => 'mtorres', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'Juan Pérez', 'cargo' => 'Administrador', 'usuario' => 'jperez', 'contraseña' => ('123456'), 'idTurno' => 2]);
        Empleado::create(['nombre' => 'Laura Díaz', 'cargo' => 'Cajera', 'usuario' => 'ldiaz', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'Andrés Moreno', 'cargo' => 'Bodeguero', 'usuario' => 'amoreno', 'contraseña' => ('123456'), 'idTurno' => 2]);
        Empleado::create(['nombre' => 'Sofía Ramírez', 'cargo' => 'Vendedora', 'usuario' => 'sramirez', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'Miguel Castro', 'cargo' => 'Repartidor', 'usuario' => 'mcastro', 'contraseña' => ('123456'), 'idTurno' => 2]);
        Empleado::create(['nombre' => 'Camila Rojas', 'cargo' => 'Encargada de Inventario', 'usuario' => 'crojas', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'Jorge Martínez', 'cargo' => 'Seguridad', 'usuario' => 'jmartinez', 'contraseña' => ('123456'), 'idTurno' => 2]);
        Empleado::create(['nombre' => 'Paula Vega', 'cargo' => 'Vendedora', 'usuario' => 'pvega', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'David Suárez', 'cargo' => 'Bodeguero', 'usuario' => 'dsuarez', 'contraseña' => ('123456'), 'idTurno' => 2]);
        Empleado::create(['nombre' => 'Lucía Ortiz', 'cargo' => 'Cajera', 'usuario' => 'lortiz', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'Ricardo Peña', 'cargo' => 'Supervisor', 'usuario' => 'rpena', 'contraseña' => ('123456'), 'idTurno' => 2]);
        Empleado::create(['nombre' => 'Valentina Ruiz', 'cargo' => 'Asistente de Compras', 'usuario' => 'vruiz', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'Fernando Gil', 'cargo' => 'Limpieza', 'usuario' => 'fgil', 'contraseña' => ('123456'), 'idTurno' => 2]);
        Empleado::create(['nombre' => 'Natalia Cruz', 'cargo' => 'Cajera', 'usuario' => 'ncruz', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'Óscar Herrera', 'cargo' => 'Repartidor', 'usuario' => 'oherrera', 'contraseña' => ('123456'), 'idTurno' => 2]);
        Empleado::create(['nombre' => 'Elena Vargas', 'cargo' => 'Vendedora', 'usuario' => 'evargas', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'Tomás Arias', 'cargo' => 'Administrador', 'usuario' => 'tarias', 'contraseña' => ('123456'), 'idTurno' => 2]);
        Empleado::create(['nombre' => 'Sara Mejía', 'cargo' => 'Cajera', 'usuario' => 'smejia', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'Felipe Castro', 'cargo' => 'Bodeguero', 'usuario' => 'fcastro', 'contraseña' => ('123456'), 'idTurno' => 2]);
        Empleado::create(['nombre' => 'Daniela Molina', 'cargo' => 'Vendedora', 'usuario' => 'dmolina', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'Iván Torres', 'cargo' => 'Seguridad', 'usuario' => 'itorres', 'contraseña' => ('123456'), 'idTurno' => 2]);
        Empleado::create(['nombre' => 'Juliana Pérez', 'cargo' => 'Asistente de Compras', 'usuario' => 'jperez2', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'Sebastián Díaz', 'cargo' => 'Supervisor', 'usuario' => 'sdiaz', 'contraseña' => ('123456'), 'idTurno' => 2]);
        Empleado::create(['nombre' => 'Laura Ramírez', 'cargo' => 'Cajera', 'usuario' => 'lramirez', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'Andrés Pineda', 'cargo' => 'Bodeguero', 'usuario' => 'apineda', 'contraseña' => ('123456'), 'idTurno' => 2]);
        Empleado::create(['nombre' => 'Mónica Herrera', 'cargo' => 'Vendedora', 'usuario' => 'mherrera', 'contraseña' => ('123456'), 'idTurno' => 1]);
        Empleado::create(['nombre' => 'Pablo Medina', 'cargo' => 'Repartidor', 'usuario' => 'pmedina', 'contraseña' => ('123456'), 'idTurno' => 2]);
    }
}
