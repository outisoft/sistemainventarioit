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
        Schema::create('schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('employee_id')->constrained('users')->cascadeOnDelete();
            $table->time('start_time'); // Hora de entrada (ej: 08:00:00)
            $table->time('end_time');   // Hora de salida (ej: 16:00:00)
            $table->json('days');       // Días aplicables (ej: ["monday", "tuesday"])
            $table->boolean('is_active')->default(true); // Para activar/desactivar el horario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
