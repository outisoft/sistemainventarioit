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
            ['name' => 'MÉXICO'],
            ['name' => 'JAMAICA'],
            ['name' => 'REPUBLICA DOMINICANA'],
            ['name' => 'ESPAÑA'],
        ];
        DB::table('regions')->insert($datos);
    }
}
