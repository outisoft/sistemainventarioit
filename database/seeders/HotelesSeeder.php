<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            ['nombre' => 'Akumal', 'tipo' => 'Luxury'],
            ['nombre' => 'Coba', 'tipo' => 'Grand'],
            ['nombre' => 'Sian Ka´an', 'tipo' => 'Luxury'],
            ['nombre' => 'Tulum', 'tipo' => 'Grand'],
        ];

        // Agregar los datos a la tabla "hoteles"
        DB::table('hotels')->insert($datos);
    }
}
