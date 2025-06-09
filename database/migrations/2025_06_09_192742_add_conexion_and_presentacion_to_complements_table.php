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
        Schema::table('complements', function (Blueprint $table) {
            // CORRECTO: Se permite que el campo sea nulo.
            $table->string('tipo_conexion', 20)->nullable()->after('type_id');
            $table->string('tipo_presentacion', 20)->nullable()->after('tipo_conexion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complements', function (Blueprint $table) {
            $table->dropColumn(['tipo_conexion', 'tipo_presentacion']);
        });
    }
};
