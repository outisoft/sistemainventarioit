<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecificLocation extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dates = [
            ['name' => 'LOBBY', 'hotel_id' => 1,],
            ['name' => 'LOBBY', 'hotel_id' => 2,],
            ['name' => 'LOBBY', 'hotel_id' => 9,],
            ['name' => 'LOBBY', 'hotel_id' => 12,],
            ['name' => 'LOBBY', 'hotel_id' => 13,],
            ['name' => 'GYM', 'hotel_id' => 1,],
            ['name' => 'GYM', 'hotel_id' => 2,],
            ['name' => 'GYM', 'hotel_id' => 9,],
            ['name' => 'GYM', 'hotel_id' => 12,],
            ['name' => 'GYM', 'hotel_id' => 13,],
            ['name' => 'POOL BAR', 'hotel_id' => 1,],
            ['name' => 'POOL BAR', 'hotel_id' => 2,],
            ['name' => 'POOL BAR', 'hotel_id' => 9,],
            ['name' => 'POOL BAR', 'hotel_id' => 12,],
            ['name' => 'POOL BAR', 'hotel_id' => 13,],
        ];

        // Agregar los datos a la tabla "hoteles"
        DB::table('specific_locations')->insert($dates);
    }
}
