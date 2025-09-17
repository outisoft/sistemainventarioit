<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            ['name' => 'TULUM COUNTRY CLUB'],
            ['name' => 'JAMAICA'],
            ['name' => 'REPUBLICA DOMINICANA'],
            ['name' => 'ESPAÑA'],
            ['name' => 'MEXICO'],
        ];
        DB::table('regions')->insert($datos);
    }
}
