<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChangeIdToUuidInEmpleadosAndEmpleadoEquipo extends Migration
{
    public function up()
    {
        // Agregar columnas UUID temporales
        Schema::table('empleados', function (Blueprint $table) {
            $table->uuid('uuid_temp')->nullable();
        });

        Schema::table('empleado_equipo', function (Blueprint $table) {
            $table->uuid('empleado_uuid_temp')->nullable();
        });

        // Generar UUIDs para los registros existentes
        DB::table('empleados')->get()->each(function ($item) {
            DB::table('empleados')
                ->where('id', $item->id)
                ->update(['uuid_temp' => Str::uuid()]);
        });

        DB::table('empleado_equipo')->get()->each(function ($item) {
            $empleado = DB::table('empleados')->where('id', $item->empleado_id)->first();
            DB::table('empleado_equipo')
                ->where('id', $item->id)
                ->update(['empleado_uuid_temp' => $empleado->uuid_temp]);
        });

        // Eliminar claves foráneas y columnas de ID antiguas
        Schema::table('empleado_equipo', function (Blueprint $table) {
            $table->dropForeign(['empleado_id']);
            $table->dropColumn('empleado_id');
        });

        Schema::table('empleados', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->dropColumn('id');
            $table->uuid('id')->primary()->change();
        });

        Schema::table('empleado_equipo', function (Blueprint $table) {
            $table->uuid('empleado_id')->change();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
        });

        // Copiar UUIDs temporales a las nuevas columnas
        DB::table('empleados')->update([
            'id' => DB::raw('uuid_temp')
        ]);

        DB::table('empleado_equipo')->update([
            'empleado_id' => DB::raw('empleado_uuid_temp')
        ]);

        // Eliminar columnas temporales
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropColumn('uuid_temp');
        });

        Schema::table('empleado_equipo', function (Blueprint $table) {
            $table->dropColumn('empleado_uuid_temp');
        });
    }

    public function down()
    {
        // Revertir los cambios en caso de rollback
        Schema::table('empleado_equipo', function (Blueprint $table) {
            $table->dropForeign(['empleado_id']);
            $table->dropColumn('empleado_id');
        });

        Schema::table('empleados', function (Blueprint $table) {
            $table->increments('id')->first();
        });

        Schema::table('empleado_equipo', function (Blueprint $table) {
            $table->unsignedInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
        });
    }
}