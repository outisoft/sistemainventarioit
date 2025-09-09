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
        Schema::create('cctv_switches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('idf_id')->nullable();
            $table->enum('zona', ['A', 'B', 'C'])->nullable()->index();
            $table->foreignId('location_id')->nullable()->constrained('specific_locations')->nullOnDelete();
            $table->string('brand');
            $table->string('model');
            $table->string('serial')->unique();
            $table->string('mac')->unique();
            $table->string('ip')->unique();
            $table->string('password')->nullable();

            // Nuevo campo: tipo de switch
            $table->enum('tipo', ['principal', 'secundario', 'idf'])->default('idf');

            // Si es secundario o IDF, puede estar conectado a otro switch
            $table->foreignId('connected_to_id')->nullable()->constrained('cctv_switches')->nullOnDelete();

            // Puerto en el que está conectado
            $table->string('connected_port')->nullable();

            // Si es principal, viene de proveedor
            $table->boolean('from_provider')->default(false);

            $table->foreignId('region_id')->constrained();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cctv_switches');
    }
};
