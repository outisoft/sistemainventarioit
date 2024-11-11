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
        Schema::create('swittches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('marca');
            $table->string('model');
            $table->string('serial')->unique();
            $table->string('mac')->unique();
            $table->string('ip')->unique();
            $table->integer('total_ports');
            $table->foreignId('hotel_id')->constrained();
            $table->longText('observacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swittches');
    }
};
