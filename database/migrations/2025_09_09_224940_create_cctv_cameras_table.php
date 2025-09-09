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
        Schema::create('cctv_cameras', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('idf')->nullable();
            $table->enum('zona', ['A', 'B', 'C'])->nullable()->index();
            $table->foreignId('location_id')->nullable()->constrained('specific_locations')->nullOnDelete();
            $table->string('brand');
            $table->string('model');
            $table->string('serial')->unique();
            $table->string('mac')->unique();
            $table->string('ip')->unique();

            // tipo de cámara (se obtiene de la tabla type_cameras)
            $table->foreignId('type_camera_id')->nullable()->constrained('type_cameras')->nullOnDelete();

            // Switch al que está conectada
            $table->foreignId('switch_id')->constrained('cctv_switches')->onDelete('cascade');

            // Puerto del switch
            $table->string('connected_port')->nullable();

            // Región
            $table->foreignId('region_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cctv_cameras');
    }
};
