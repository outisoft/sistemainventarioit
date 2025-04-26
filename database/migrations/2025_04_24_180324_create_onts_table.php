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
        Schema::create('onts', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name')->unique();
            $table->string('brand');
            $table->string('model');
            $table->string('serial')->unique();
            $table->string('mac')->unique();
            $table->string('ip')->unique();
            $table->foreignId('hotel_id')->constrained();
            $table->foreignUuid('villa_id')->nullable()->constrained('villas');
            $table->foreignUuid('room_id')->nullable()->constrained('rooms');
            $table->foreignId('region_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onts');
    }
};
