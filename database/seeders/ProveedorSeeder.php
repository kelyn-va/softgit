<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proveedor::create(['nombre' => 'Distribuidora Andina', 'contacto' => 'Luis Ramírez', 'telefono' => '3004567890', 'direccion' => 'Calle 10 #23-45']);
        Proveedor::create(['nombre' => 'Comercializadora La Estrella', 'contacto' => 'María López', 'telefono' => '3012345678', 'direccion' => 'Carrera 7 #12-34']);
        Proveedor::create(['nombre' => 'Proveedor Express', 'contacto' => 'Carlos Gómez', 'telefono' => '3123456789', 'direccion' => 'Av. Principal 45-67']);
        Proveedor::create(['nombre' => 'Suministros del Norte', 'contacto' => 'Ana Torres', 'telefono' => '3109876543', 'direccion' => 'Calle 56 #8-22']);
        Proveedor::create(['nombre' => 'Mayoristas del Sur', 'contacto' => 'Diego Martínez', 'telefono' => '3156781234', 'direccion' => 'Carrera 45 #19-10']);
        Proveedor::create(['nombre' => 'Distribuciones Globales', 'contacto' => 'Laura Díaz', 'telefono' => '3201239876', 'direccion' => 'Calle 80 #30-55']);
        Proveedor::create(['nombre' => 'Alianza Comercial', 'contacto' => 'Sofía Ruiz', 'telefono' => '3015672345', 'direccion' => 'Cra 100 #15-20']);
        Proveedor::create(['nombre' => 'Importadora Mundial', 'contacto' => 'Óscar Pineda', 'telefono' => '3119087654', 'direccion' => 'Av. Libertador 12-60']);
        Proveedor::create(['nombre' => 'Central de Suministros', 'contacto' => 'Paula Vergara', 'telefono' => '3146578934', 'direccion' => 'Calle 33 #7-89']);
        Proveedor::create(['nombre' => 'Comercializadora Omega', 'contacto' => 'Julián Hernández', 'telefono' => '3009871234', 'direccion' => 'Diagonal 15 #40-21']);
        Proveedor::create(['nombre' => 'Soluciones Industriales', 'contacto' => 'Natalia Ríos', 'telefono' => '3216547890', 'direccion' => 'Calle 98 #22-14']);
        Proveedor::create(['nombre' => 'Mercantil Bogotá', 'contacto' => 'Héctor Peña', 'telefono' => '3198765432', 'direccion' => 'Cra 50 #9-55']);
        Proveedor::create(['nombre' => 'Proveedor Total', 'contacto' => 'Valentina Castro', 'telefono' => '3165432178', 'direccion' => 'Calle 2 #1-33']);
        Proveedor::create(['nombre' => 'Distribuidora Nova', 'contacto' => 'Ricardo Mora', 'telefono' => '3025679812', 'direccion' => 'Av. 5 #20-44']);
        Proveedor::create(['nombre' => 'Suministros Mega', 'contacto' => 'Angélica Torres', 'telefono' => '3126789012', 'direccion' => 'Calle 60 #14-15']);
        Proveedor::create(['nombre' => 'Grupo Proveedora', 'contacto' => 'Daniel Suárez', 'telefono' => '3006782345', 'direccion' => 'Carrera 12 #90-12']);
        Proveedor::create(['nombre' => 'Comercial del Valle', 'contacto' => 'Marcela Silva', 'telefono' => '3178964520', 'direccion' => 'Transversal 9 #76-24']);
        Proveedor::create(['nombre' => 'Proveedor Elite', 'contacto' => 'Fernando Cruz', 'telefono' => '3098765432', 'direccion' => 'Calle 99 #45-33']);
        Proveedor::create(['nombre' => 'Distribuidora Orion', 'contacto' => 'Mónica Rodríguez', 'telefono' => '3187654321', 'direccion' => 'Cra 76 #33-22']);
        Proveedor::create(['nombre' => 'Importador Andes', 'contacto' => 'Camilo Rincón', 'telefono' => '3056783456', 'direccion' => 'Calle 25 #11-98']);
    }
}
