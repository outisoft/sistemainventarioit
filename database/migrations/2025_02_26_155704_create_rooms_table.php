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
        Schema::create('rooms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('number');
            $table->uuid('villa_id')->constrained('villas')->cascadeOnDelete(); // Más claro
            $table->foreignId('region_id')->constrained()->restrictOnDelete();
            $table->timestamps();
            
            $table->unique(['villa_id', 'number']); // Evitar números duplicados por villa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
