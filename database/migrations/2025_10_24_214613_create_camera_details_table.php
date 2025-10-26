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
        Schema::create('camera_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->unique()->constrained('devices')->onDelete('cascade');
            
            $table->string('resolution')->nullable();
            $table->boolean('is_ptz')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camera_details');
    }
};
