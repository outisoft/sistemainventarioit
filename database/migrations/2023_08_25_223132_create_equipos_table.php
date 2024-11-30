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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_id')->references('id')->on('tipos')->cascadeOnDelete();
            $table->string('marca')->nullable();
            $table->string('model')->nullable();
            $table->string('serial')->nullable()->unique();
            $table->string('name')->nullable()->unique();
            $table->string('ip')->nullable()->unique();
            $table->string('so')->nullable();
            $table->foreignId('policy_id')->nullable()->references('id')->on('policies')->cascadeOnDelete();
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('no_contrato')->nullable();
            $table->string('orden')->nullable();
            $table->foreignId('region_id')->constrained();
            //app
            /*$table->string('nombre_app')->nullable();
            $table->string('so')->nullable();
            $table->string('office')->nullable();
            $table->string('clave')->nullable();*/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
