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
        Schema::create('switch_details', function (Blueprint $table) {
            $table->id();

            // Relación 1 a 1 con un dispositivo
            $table->foreignId('device_id')
                  ->unique() // Asegura que solo haya un registro por dispositivo
                  ->constrained('devices')
                  ->onDelete('cascade'); // Si se borra el device, se borra su detalle

            // Tu campo específico
            $table->integer('total_ports');

            // Campos recomendados
            $table->boolean('is_managed')->default(false);
            $table->boolean('is_poe')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('switch_details');
    }
};
