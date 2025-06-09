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
        Schema::create('equipment_position', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Opcional: la tabla pivote puede tener su propio ID UUID
            // $table->primary(['position_id', 'equipo_id']); // Alternativa si no quieres un 'id' separado

            $table->foreignUuid('position_id')->constrained('positions')->onDelete('cascade'); // FK a UUID
            $table->foreignId('equipo_id')->constrained('equipos')->onDelete('cascade'); // Asumiendo que equipos.id es un entero
            // Si equipos.id también es UUID:
            // $table->foreignUuid('equipo_id')->constrained('equipos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_position');
    }
};
