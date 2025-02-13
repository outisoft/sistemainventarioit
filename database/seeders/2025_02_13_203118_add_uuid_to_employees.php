<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
        // Agregar columnas UUID temporales
        Schema::table('empleados', function (Blueprint $table) {
            if (!Schema::hasColumn('empleados', 'uuid_temp')) {
                $table->uuid('uuid_temp')->nullable();
            }
        });

        Schema::table('empleado_equipo', function (Blueprint $table) {
            if (!Schema::hasColumn('empleado_equipo', 'empleado_uuid_temp')) {
                $table->uuid('empleado_uuid_temp')->nullable();
            }
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

        // Deshabilitar restricciones de clave foránea
        Schema::disableForeignKeyConstraints();

        // Eliminar claves foráneas y columnas de ID antiguas
        Schema::table('empleado_equipo', function (Blueprint $table) {
            $table->dropForeign(['empleado_id']);
            $table->dropColumn('empleado_id');
        });

        // Eliminar el atributo AUTO_INCREMENT y la clave primaria de la columna id
        DB::statement('ALTER TABLE empleados MODIFY id INT NOT NULL');
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->dropColumn('id');
        });

        // Agregar la nueva columna UUID como primaria
        Schema::table('empleados', function (Blueprint $table) {
            $table->uuid('id')->primary()->first();
        });

        Schema::table('empleado_equipo', function (Blueprint $table) {
            $table->uuid('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
        });

        // Habilitar restricciones de clave foránea
        Schema::enableForeignKeyConstraints();

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
        Schema::disableForeignKeyConstraints();

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

        Schema::enableForeignKeyConstraints();
    }
};