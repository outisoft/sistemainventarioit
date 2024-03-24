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
        Schema::create('tablets', function (Blueprint $table) {
            $table->id();
            $table->string('operario');
            $table->string('puesto');
            $table->string('email')->unique();
            $table->string('usuario');
            $table->string('password');
            $table->string('numero_tableta');
            $table->string('serial');
            $table->string('numero_telefono');
            $table->string('imei');
            $table->string('sim');
            $table->string('politica');
            $table->boolean('configurada');
            $table->boolean('carta_firmada');
            $table->longText('observacion');
            $table->string('giacode');
            $table->string('personalsdscode');
            $table->string('folio_baja')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tablets');
    }
};
