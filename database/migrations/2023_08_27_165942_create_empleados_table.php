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
            $table->string('no_empleado');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('puesto');
            $table->string('departamento');
            $table->unsignedBigInteger('hotel_id');
            $table->string('ad')->unique();

            // Configura la clave foránea
            $table->foreign('hotel_id')->references('id')->on('hotels');
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
