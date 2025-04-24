<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Swittch;
use App\Models\DeviceLocation;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Obtener todos los switches sin ubicación
        $switchesWithoutLocation = Swittch::doesntHave('location')->get();
        
        foreach ($switchesWithoutLocation as $switch) {
            DeviceLocation::create([
                'locatable_id' => $switch->id,
                'locatable_type' => Swittch::class,
                'villa_id' => null,
                'room_id' => null,
                'specific_location_id' => null
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
