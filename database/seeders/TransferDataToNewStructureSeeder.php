<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Para registrar información útil
use Illuminate\Support\Str; // Para generar UUIDs

class TransferDataToNewStructureSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $this->command->info('Iniciando transferencia de datos...');

            // Paso 1: Migrar configuraciones de puesto únicas a `puestos` (positions)
            $this->command->info('Migrando configuraciones de puesto...');
            $empleadosOriginales = DB::table('empleados')->orderBy('id')->get(); // O el orden que prefieras
            $mapPuestoOriginalToNuevoId = []; // Para mapear la configuración original a la nueva ID de puesto

            foreach ($empleadosOriginales as $eo) {
                // Crear un hash o clave única para la combinación de atributos del puesto
                $puestoConfigKey = md5(
                    strtolower(trim($eo->email ?? '')) . '|' .       // Usa ?? '' para manejar nulos, trim() para espacios, strtolower() para mayúsculas/minúsculas
                    strtolower(trim($eo->puesto ?? '')) . '|' .
                    trim($eo->departamento_id ?? '') . '|' .         // Asumiendo que se llama departamento_id y es el ID
                    trim($eo->hotel_id ?? '') . '|' .                // Asumiendo que se llama hotel_id y es el ID
                    strtolower(trim($eo->ad ?? '')).
                    trim($eo->region_id ?? '') . '|'
                );

                if (!isset($mapPuestoOriginalToNuevoId[$puestoConfigKey])) {
                    try {
                        $nuevoPuestoUuid = Str::uuid()->toString(); // <--- Generar UUID para el puesto
                        DB::table('positions')->insert([          // <--- Usar 'positions'
                            'id' => $nuevoPuestoUuid,             // <--- Incluir el ID generado
                            'email' => $eo->email,
                            'position' => $eo->puesto,
                            'department_id' => $eo->departamento_id,
                            'hotel_id' => $eo->hotel_id,
                            'ad' => $eo->ad,
                            'region_id' => $eo->region_id,
                            'created_at' => $eo->created_at ?? now(),
                            'updated_at' => $eo->updated_at ?? now(),
                        ]);
                        $mapPuestoOriginalToNuevoId[$puestoConfigKey] = $nuevoPuestoUuid; // Guardar el UUID
                    } catch (\Illuminate\Database\QueryException $e) {
                        // ... tu manejo de errores ...
                        // Si buscas un puesto existente, asegúrate de que estás comparando los campos correctos
                        $existingPuesto = DB::table('positions')
                            ->where('email', $eo->email) // Ajusta según tu definición de unicidad
                            ->first();
                        if ($existingPuesto) {
                            $mapPuestoOriginalToNuevoId[$puestoConfigKey] = $existingPuesto->id; // El ID existente ya será un UUID
                        } else {
                            // ... error ...
                        }
                    }
                }
            }
            $this->command->info(count($mapPuestoOriginalToNuevoId) . ' configuraciones de puesto únicas migradas.');

            // Paso 2: Migrar empleados a `informacion_empleados` y enlazar a `informacion_puestos`
            $this->command->info('Migrando empleados...');
            $mapNumeroEmpleadoToNuevoEmpleadoId = []; // Para la migración de la tabla pivote

            foreach ($empleadosOriginales as $eo) {
                $puestoConfigKey = md5(
                    strtolower(trim($eo->email ?? '')) . '|' .       // Usa ?? '' para manejar nulos, trim() para espacios, strtolower() para mayúsculas/minúsculas
                    strtolower(trim($eo->puesto ?? '')) . '|' .
                    trim($eo->departamento_id ?? '') . '|' .         // Asumiendo que se llama departamento_id y es el ID
                    trim($eo->hotel_id ?? '') . '|' .                // Asumiendo que se llama hotel_id y es el ID
                    strtolower(trim($eo->ad ?? '')).
                    trim($eo->region_id ?? '') . '|' 
                );

                $positionUuid = $mapPuestoOriginalToNuevoId[$puestoConfigKey] ?? null; // Esto ahora es un UUID

                if ($positionUuid === null) {
                    Log::warning("No se encontró UUID de puesto para empleado original ID {$eo->id} (no_employee {$eo->no_empleado}). Se asignará NULL.");
                }

                $nuevoEmpleadoUuid = Str::uuid()->toString(); // <--- Generar UUID para el empleado
                DB::table('employees')->insert([             // <--- Usar 'employees'
                    'id' => $nuevoEmpleadoUuid,              // <--- ¡LA SOLUCIÓN A TU ERROR! Incluir el ID generado.
                    'no_employee' => $eo->no_empleado,   // Asegúrate que $eo->numero_empleado sea el nombre correcto de la columna en la tabla original
                    'name' => $eo->name,                   // Asegúrate que $eo->nombre sea el nombre correcto
                    'position_id' => $positionUuid,          // Este es el UUID del puesto relacionado
                    'region_id' => $eo->region_id,
                    'created_at' => $eo->created_at ?? now(),
                    'updated_at' => $eo->updated_at ?? now(),
                ]);

                // $eo->id es el ID de la tabla empleados original (que podría ser un int o lo que fuera)
                $mapNumeroEmpleadoToNuevoEmpleadoId[$eo->id] = [
                    'empleado_id' => $nuevoEmpleadoUuid, // Guardar el UUID del nuevo empleado
                    'positions_id' => $positionUuid    // Guardar el UUID del puesto asignado
                ];
            }
            $this->command->info(count($empleadosOriginales) . ' empleados migrados.');


            // Paso 3: Migrar datos de la tabla pivote `empleado_equipo` a `equipo_puesto`
            $this->command->info('Migrando relaciones empleado-equipo a equipo-puesto...');
            // Asumiendo que tu tabla pivote se llama 'empleado_equipo' y tiene 'empleado_id' y 'equipo_id'
            $pivoteOriginal = DB::table('empleado_equipo')->get(); // Ajusta el nombre de la tabla si es diferente
            $countPivote = 0;
            foreach ($pivoteOriginal as $pivote) {
                // $pivote->empleado_id es el ID de la tabla 'empleados' ORIGINAL
                $empleadoData = $mapNumeroEmpleadoToNuevoEmpleadoId[$pivote->empleado_id] ?? null; // <--- CORREGIDO

                if ($empleadoData && $empleadoData['positions_id']) {
                    DB::table('equipment_position')->insert([ // Nombre correcto de tu tabla pivote NUEVA
                        'id' => Str::uuid()->toString(), // Si la tabla pivote tiene su propio id UUID
                        'position_id' => $empleadoData['positions_id'], // Este es el UUID del puesto
                        'equipo_id' => $pivote->equipo_id, // ID del equipo
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $countPivote++;
                } else {
                    Log::warning("No se pudo migrar relación para empleado_id original {$pivote->empleado_id} y equipo_id {$pivote->equipo_id}. Puesto no encontrado o no asociado."); // <--- CORREGIDO
                }
            }
            $this->command->info($countPivote . ' relaciones de equipo-puesto migradas.');

            $this->command->info('Transferencia de datos completada exitosamente.');
        });
    }
}