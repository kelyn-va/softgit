<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Categorias;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Bebidas',
            'Snacks',
            'Lácteos',
            'Aseo Personal',
            'Limpieza del Hogar',
            'Panadería',
            'Frutas y Verduras',
            'Carnes y Embutidos',
            'Cereales y Granos',
            'Mascotas',
            'Hogar y Cocina',
            'Electrónicos',
            'Ropa y Calzado',
            'Juguetería',
            'Cuidado del Bebé',
            'Ferretería',
            'Papelería',
            'Farmacia',
            'Congelados',
            'Automotriz',
        ];

        foreach ($categorias as $nombre) {
            Categorias::create(['nombre' => $nombre]);
        }
    }
}
