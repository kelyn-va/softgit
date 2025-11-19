<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('es_CO');

        $clientes = [];

        for ($i = 0; $i < 100; $i++) {
            $clientes[] = [
                'Nombre' => $faker->name,
                'Telefono' => $faker->numerify('3#########'),
                'Email' => $faker->unique()->safeEmail,
                'Direccion' => substr($faker->address, 0, 100),
            ];
        }

        foreach (array_chunk($clientes, 500) as $chunk) {
            DB::table('clientes')->insert($chunk);
        }
    }
}
