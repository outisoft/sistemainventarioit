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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id')->references('id')->on('equipos')->cascadeOnDelete(); // Relación con la tabla equipments
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete(); // Relación con la tabla users
            $table->enum('maintenance_type', ['preventivo', 'correctivo']);
            $table->date('date');
            $table->text('description');
            $table->json('parts_used')->nullable(); // Lista de partes usadas en formato JSON
            $table->enum('status', ['Completado', 'Pendiente'])->default('Pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
