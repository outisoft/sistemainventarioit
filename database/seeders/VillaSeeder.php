<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class VillaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dates = [
            //ska
            ['id' => Uuid::uuid4()->toString(), 'name' => '1A4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '1B4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '2A4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '2B4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '3A4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '3B4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '4A4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '4B4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '5A4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '5B4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '6A4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '6B4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '7A4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '7B4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '8A4', 'hotel_id' => 9, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '8B4', 'hotel_id' => 9, 'region_id' => 1],
            //tulum
            ['id' => Uuid::uuid4()->toString(), 'name' => '01', 'hotel_id' => 12, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '02', 'hotel_id' => 12, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '03', 'hotel_id' => 12, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '04', 'hotel_id' => 12, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '05', 'hotel_id' => 12, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '06', 'hotel_id' => 12, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '07', 'hotel_id' => 12, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '08', 'hotel_id' => 12, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '09', 'hotel_id' => 12, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '10', 'hotel_id' => 12, 'region_id' => 1],
            //akumal
            ['id' => Uuid::uuid4()->toString(), 'name' => '46', 'hotel_id' => 1, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '47', 'hotel_id' => 1, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '48', 'hotel_id' => 1, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '49', 'hotel_id' => 1, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '50', 'hotel_id' => 1, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '51', 'hotel_id' => 1, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '52', 'hotel_id' => 1, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '53', 'hotel_id' => 1, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '54', 'hotel_id' => 1, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '55', 'hotel_id' => 1, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '56', 'hotel_id' => 1, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '57', 'hotel_id' => 1, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '58', 'hotel_id' => 1, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '59', 'hotel_id' => 1, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '60', 'hotel_id' => 1, 'region_id' => 1],
            //coba
            ['id' => Uuid::uuid4()->toString(), 'name' => '1A3', 'hotel_id' => 2, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '1B3', 'hotel_id' => 2, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '2A3', 'hotel_id' => 2, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '2B3', 'hotel_id' => 2, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '3A3', 'hotel_id' => 2, 'region_id' => 1],
            ['id' => Uuid::uuid4()->toString(), 'name' => '3B3', 'hotel_id' => 2, 'region_id' => 1],
        ];

        // Agregar los datos a la tabla "hoteles"
        DB::table('villas')->insert($dates);
    }
}

