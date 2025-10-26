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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();

            // Campo clave para saber qué tipo de equipo es y qué tabla de detalle buscar
            $table->enum('type', ['switch', 'ap', 'camera', 'ont']);

            // Campos de "Fábrica" (requeridos)
            $table->string('brand');
            $table->string('model');
            $table->string('serial')->unique(); // El S/N debe ser único
            $table->string('mac')->unique()->nullable(); // La MAC también, pero puede ser nulable

            // Tu campo de estado
            $table->enum('status', ['en_stock', 'en_sitio'])->default('en_stock');

            // --- Campos NULABLES (solo para equipos "en_sitio") ---
            $table->string('name')->nullable(); // Ej: "SW_PISO_1"
            $table->ipAddress('ip')->nullable();

            // Llaves foráneas que solo se llenan "en_sitio"
            $table->foreignId('location_id')->nullable()->constrained('specific_locations');
            $table->foreignId('network_id')->nullable()->constrained('networks');
            
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
