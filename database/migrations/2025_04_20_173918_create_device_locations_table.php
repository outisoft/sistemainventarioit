<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('device_locations', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('locatable_id');
            $table->uuid('locatable_id'); // ← SOLUCIÓN
            $table->string('locatable_type');
            
            $table->foreignUuid('villa_id')->nullable()->constrained('villas');
            $table->foreignUuid('room_id')->nullable()->constrained('rooms');
            $table->foreignId('specific_location_id')->nullable()->constrained('specific_locations');
            
            $table->timestamps();
            
            $table->unique(['locatable_id', 'locatable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_locations');
    }
};
