<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->foreignId('type_id')->references('id')->on('tipos')->cascadeOnDelete();
            $table->string('type');
            $table->string('key');
            $table->date('end_date')->nullable(); // Solo para Office 365
            $table->integer('max')->default(1);
            $table->foreignId('region_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};