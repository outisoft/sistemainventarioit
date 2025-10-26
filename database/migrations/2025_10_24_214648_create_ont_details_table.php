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
        Schema::create('ont_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->unique()->constrained('devices')->onDelete('cascade');
            
            $table->integer('wan_ports')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ont_details');
    }
};
