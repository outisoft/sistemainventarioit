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
        Schema::table('swittches', function (Blueprint $table) {
            $table->string('usage_type')->default('Administrative')->after('region_id');; // Valores: 'administrative' o 'client'
        });
    }

    public function down()
    {
        Schema::table('swittches', function (Blueprint $table) {
            $table->dropColumn('usage_type');
        });
    }
};
