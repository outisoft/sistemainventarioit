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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // Ejemplo: pc, laptop, tablet, mouse
            //equipo
            $table->string('no_equipo')->nullable();
            $table->string('estado')->nullable();
            $table->string('equipo')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('serie')->nullable();
            $table->string('nombre_equipo')->nullable();
            $table->string('ip')->nullable();
            $table->string('no_contrato')->nullable();
            //app
            $table->string('nombre_app')->nullable();
            $table->string('so')->nullable();
            $table->string('office')->nullable();
            $table->string('clave')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
