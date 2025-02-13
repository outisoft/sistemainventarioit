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
        Schema::create('empleado_equipo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleado_id')->references('id')->on('empleados')->cascadeOnDelete();
            $table->foreignId('equipo_id')->references('id')->on('equipos')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado_equipo');
    }
};
