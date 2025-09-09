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
        Schema::create('phone_position', function (Blueprint $table) {
            $table->id();
            $table->uuid('phone_id')->nullable()->constrained('phones', 'id')->onDelete('cascade');
            $table->uuid('position_id')->nullable()->constrained('positions', 'id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_position');
    }
};
