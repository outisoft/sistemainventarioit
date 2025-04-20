<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener el UUID de la villa recién creada
        $villaUuid = DB::table('villas')->value('uuid');

        $dates = [
            ['number' => '01', 'villa_id' => $villaUuid, 'region_id' => 1],
        ];

        // Agregar los datos a la tabla "rooms"
        DB::table('rooms')->insert($dates);
    }
}
