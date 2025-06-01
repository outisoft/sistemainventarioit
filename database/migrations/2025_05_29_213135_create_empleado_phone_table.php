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
        Schema::create('empleado_phone', function (Blueprint $table) {
            $table->id();
            $table->uuid('empleado_id')->nullable()->constrained('empleados', 'id')->onDelete('cascade');
            $table->uuid('phone_id')->nullable()->constrained('phones', 'id')->onDelete('cascade');
            $table->timestamps();
        });    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado_phone');
    }
};
