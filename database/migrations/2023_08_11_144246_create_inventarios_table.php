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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('precio')->nullable();

            /*$table->string('no_equipo')->nullable();
            $table->string('estado')->nullable();
            $table->string('equipo')->nullable();
            //basico
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('no_serie')->nullable();
            // Otros
            $table->string('nombre_equipo')->nullable();
            $table->string('ip_equipo')->nullable();
            $table->string('no_contrato')->nullable();*/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
