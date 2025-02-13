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
        Schema::create('access_points', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name')->unique();
            $table->string('marca');
            $table->string('model');
            $table->string('serial')->unique();
            $table->string('mac')->unique();
            $table->string('ip')->unique();
            $table->foreignId('swittch_id')->references('id')->on('swittches')->cascadeOnDelete();
            $table->integer('port_number');
            $table->foreignId('region_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_points');
    }
};
