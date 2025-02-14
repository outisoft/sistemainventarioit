<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('breack_switch', function (Blueprint $table) {
            $table->id();
            $table->foreignId('switch_id')->references('id')->on('swittches')->cascadeOnDelete();
            $table->foreignId('complement_id')->references('id')->on('complements')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('breack_switch');
    }
};
