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
        Schema::create('coming2s', function (Blueprint $table) {
            $table->id();
            $table->string('operario');
            $table->string('puesto');
            $table->string('email')->unique();
            $table->string('usuario');
            $table->string('password');
            $table->string('numero_tableta')->unique();
            $table->string('serial')->unique();
            $table->string('numero_telefono')->unique();
            $table->string('imei')->unique();
            $table->string('sim')->unique();
            $table->foreignId('policy_id')->references('id')->on('policies')->cascadeOnDelete();
            $table->boolean('configurada')->default(false);
            $table->boolean('carta_firmada')->default(false);
            $table->longText('observacion');
            $table->string('folio_baja')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coming2s');
    }
};
