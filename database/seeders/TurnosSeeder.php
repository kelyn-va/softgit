<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TurnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('turnos')->insert([
            [
                'InicioTurno' => '2025-01-01 05:00:00',
                'FinTurno' => '2025-01-01 12:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'InicioTurno' => '2025-01-01 02:00:00',
                'FinTurno' => '2025-01-01 08:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
