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
        Schema::create('tpvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained();
            $table->string('area');
            $table->foreignId('departamento_id')->references('id')->on('departamentos')->cascadeOnDelete();
            $table->foreignId('hotel_id')->references('id')->on('hotels')->cascadeOnDelete();
            $table->string('equipment'); //equipos
            $table->string('brand'); //marca
            $table->string('model');
            $table->string('no_serial')->unique();
            $table->string('name')->unique();
            $table->string('ip')->unique();
            $table->string('link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tpvs');
    }
};
