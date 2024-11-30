<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('no_empleado')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('puesto');
            $table->foreignId('departamento_id')->references('id')->on('departamentos')->cascadeOnDelete();
            $table->foreignId('hotel_id')->references('id')->on('hotels')->cascadeOnDelete();
            $table->string('ad')->unique();
            $table->foreignId('region_id')->constrained();
            //$table->unsignedBigInteger('equipo_id')->nullable();

            // Configura la clave foránea
            //$table->foreign('hotel_id')->references('id')->on('hotels');
            //$table->foreign('equipo_id')->references('id')->on('equipos');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
