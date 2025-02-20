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
        Schema::create('complements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->references('id')->on('tipos')->cascadeOnDelete();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial')->nullable()->unique();
            $table->boolean('lease')->default(false);
            $table->uuid('lease_id')->nullable()->constrained('leases', 'id')->onDelete('cascade');
            $table->foreignId('region_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complements');
    }
};
