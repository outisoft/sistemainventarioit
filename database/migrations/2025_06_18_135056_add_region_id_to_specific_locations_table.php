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
        Schema::table('specific_locations', function (Blueprint $table) {
            $table->unsignedBigInteger('region_id')->nullable()->after('hotel_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('specific_locations', function (Blueprint $table) {
            $table->dropColumn('region_id');
        });
    }
};
