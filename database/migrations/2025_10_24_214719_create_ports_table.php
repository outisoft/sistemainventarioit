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
        Schema::create('ports', function (Blueprint $table) {
            $table->id();

            // El Switch (device) al que pertenece este puerto
            $table->foreignId('switch_device_id')
                  ->constrained('devices')
                  ->onDelete('cascade'); // Si se borra el switch, se borran sus puertos

            $table->integer('port_number'); // Ej: 1, 2, 3...

            // El Dispositivo (device) que está conectado a este puerto
            $table->foreignId('connected_device_id')
                  ->nullable() // Puede estar vacío
                  ->constrained('devices')
                  ->onDelete('set null'); // Si se borra el AP, el puerto queda nulo (vacío)
            
            $table->timestamps();

            // --- RESTRICCIÓN CLAVE ---
            // No se puede asignar el mismo número de puerto dos veces AL MISMO switch
            $table->unique(['switch_device_id', 'port_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ports');
    }
};
