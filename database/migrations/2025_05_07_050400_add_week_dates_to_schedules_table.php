<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            // Primero agregar como nullable
            $table->date('week_start_date')->nullable()->after('employee_id');
            $table->date('week_end_date')->nullable()->after('week_start_date');
        });

        // Actualizar registros existentes con fechas válidas
        $weekStart = Carbon::now()->startOfWeek()->format('Y-m-d');
        $weekEnd = Carbon::now()->endOfWeek()->format('Y-m-d');
        DB::table('schedules')->update([
            'week_start_date' => $weekStart,
            'week_end_date' => $weekEnd
        ]);

        // Ahora hacer las columnas NOT NULL
        Schema::table('schedules', function (Blueprint $table) {
            $table->date('week_start_date')->nullable(false)->change();
            $table->date('week_end_date')->nullable(false)->change();
            
            // Agregar índices
            $table->index(['week_start_date', 'week_end_date']);
        });
    }

    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropIndex(['week_start_date', 'week_end_date']);
            $table->dropColumn(['week_start_date', 'week_end_date']);
        });
    }
};
