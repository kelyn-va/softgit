<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('productos')->insert([

            // 1. 🥤 BEBIDAS (idCategoria = 1)
            [
                'nombre' => 'Coca-Cola 1.5L',
                'descripcion' => 'Gaseosa Coca-Cola botella 1.5 litros.',
                'precio' => 5500,
                'stock' => 40,
                'idCategoria' => 1,
                'idProveedor' => 1,
            ],
            [
                'nombre' => 'Agua Cristal 600ml',
                'descripcion' => 'Agua pura botella 600ml.',
                'precio' => 2000,
                'stock' => 60,
                'idCategoria' => 1,
                'idProveedor' => 2,
            ],
            [
                'nombre' => 'Jugo Hit 1L',
                'descripcion' => 'Jugo sabor tropical.',
                'precio' => 3500,
                'stock' => 50,
                'idCategoria' => 1,
                'idProveedor' => 3,
            ],

            // 2. 🍪 SNACKS (idCategoria = 2)
            [
                'nombre' => 'Papas Margarita Natural 30g',
                'descripcion' => 'Papas Margarita sabor natural.',
                'precio' => 2000,
                'stock' => 100,
                'idCategoria' => 2,
                'idProveedor' => 4,
            ],
            [
                'nombre' => 'Choclitos BBQ 30g',
                'descripcion' => 'Choclitos sabor BBQ.',
                'precio' => 1800,
                'stock' => 90,
                'idCategoria' => 2,
                'idProveedor' => 5,
            ],

            // 3. 🥛 LÁCTEOS (idCategoria = 3)
            [
                'nombre' => 'Leche Alpina 1L',
                'descripcion' => 'Bolsa de leche entera.',
                'precio' => 3800,
                'stock' => 45,
                'idCategoria' => 3,
                'idProveedor' => 6,
            ],
            [
                'nombre' => 'Queso campesino 500g',
                'descripcion' => 'Queso fresco tipo campesino.',
                'precio' => 9500,
                'stock' => 20,
                'idCategoria' => 3,
                'idProveedor' => 7,
            ],

            // 4. 🧴 ASEO PERSONAL (idCategoria = 4)
            [
                'nombre' => 'Jabón Protex 125g',
                'descripcion' => 'Jabón antibacterial.',
                'precio' => 3500,
                'stock' => 25,
                'idCategoria' => 4,
                'idProveedor' => 8,
            ],

            // 5. 🧹 LIMPIEZA DEL HOGAR (idCategoria = 5)
            [
                'nombre' => 'Detergente Ariel 1kg',
                'descripcion' => 'Detergente en polvo.',
                'precio' => 7800,
                'stock' => 30,
                'idCategoria' => 5,
                'idProveedor' => 9,
            ],

            // 6. 🥖 PANADERÍA (idCategoria = 6)
            [
                'nombre' => 'Pan Bimbo 450g',
                'descripcion' => 'Pan tajado blanco.',
                'precio' => 6500,
                'stock' => 25,
                'idCategoria' => 6,
                'idProveedor' => 10,
            ],

            // 7. 🥬 FRUTAS Y VERDURAS (idCategoria = 7)
            [
                'nombre' => 'Tomate chonto (kg)',
                'descripcion' => 'Tomate fresco por kilogramo.',
                'precio' => 2800,
                'stock' => 20,
                'idCategoria' => 7,
                'idProveedor' => 11,
            ],
            [
                'nombre' => 'Papa criolla (kg)',
                'descripcion' => 'Papa criolla fresca por kilogramo.',
                'precio' => 3500,
                'stock' => 18,
                'idCategoria' => 7,
                'idProveedor' => 12,
            ],

            // 8. 🍗 CARNES Y EMBUTIDOS (idCategoria = 8)
            [
                'nombre' => 'Jamón Pietran 250g',
                'descripcion' => 'Jamón Pietran de cerdo.',
                'precio' => 8900,
                'stock' => 12,
                'idCategoria' => 8,
                'idProveedor' => 13,
            ],

            // 9. 🌾 CEREALES Y GRANOS (idCategoria = 9)
            [
                'nombre' => 'Arroz Diana 1kg',
                'descripcion' => 'Arroz blanco premium.',
                'precio' => 4500,
                'stock' => 50,
                'idCategoria' => 9,
                'idProveedor' => 14,
            ],
            [
                'nombre' => 'Lenteja 500g',
                'descripcion' => 'Paquete de lentejas.',
                'precio' => 2800,
                'stock' => 30,
                'idCategoria' => 9,
                'idProveedor' => 15,
            ],

            // 10. 🐶 COMIDAS PARA MASCOTAS (idCategoria = 10)
            [
                'nombre' => 'Concentrado Dog Chow 1kg',
                'descripcion' => 'Alimento para perro adulto.',
                'precio' => 12500,
                'stock' => 20,
                'idCategoria' => 10,
                'idProveedor' => 16,
            ],

            // 11. 📚 PAPELERÍA (idCategoria = 11)
            [
                'nombre' => 'Cuaderno cuadriculado 100 hojas',
                'descripcion' => 'Cuaderno tamaño carta.',
                'precio' => 4500,
                'stock' => 30,
                'idCategoria' => 11,
                'idProveedor' => 17,
            ],

            // 12. 💊 FARMACIA (idCategoria = 12)
            [
                'nombre' => 'Acetaminofén 500mg x10',
                'descripcion' => 'Caja de 10 tabletas.',
                'precio' => 2500,
                'stock' => 40,
                'idCategoria' => 12,
                'idProveedor' => 18,
            ],

            // 13. ❄️ CONGELADOS (idCategoria = 13)
            [
                'nombre' => 'Palitos de queso x6',
                'descripcion' => 'Palitos de queso congelados listos para freír.',
                'precio' => 9500,
                'stock' => 18,
                'idCategoria' => 13,
                'idProveedor' => 19,
            ],
            [
                'nombre' => 'Nuggets de pollo 500g',
                'descripcion' => 'Nuggets de pollo congelados.',
                'precio' => 11500,
                'stock' => 20,
                'idCategoria' => 13,
                'idProveedor' => 20,
            ],

        ]);
    }
}
