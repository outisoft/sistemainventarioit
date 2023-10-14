<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            ['name' => 'AMA DE LLAVES'],
            ['name' => 'AYB'],
            ['name' => 'CAFETERIA'],
            ['name' => 'CALIDAD'],
            ['name' => 'COCINA'],
            ['name' => 'COMPRAS'],
            ['name' => 'DIRECCION'],
            ['name' => 'DIRECCION A&B'],
            ['name' => 'DIRECCION GENERAL'],
            ['name' => 'DIRECCION GOLF'],
            ['name' => 'DIRECCION MANTENIMIENTO'],
            ['name' => 'DIRECCION OBRA Y GOLF'],
            ['name' => 'DIRECCION RECIDENCIAL'],
            ['name' => 'DIRECCION VENTAS RECIDENCIAL'],
            ['name' => 'ENTRETENIMIENTO'],
            ['name' => 'EXPRESS SERVICE'],
            ['name' => 'FINANZAS'],
            ['name' => 'FINANZAS'],
            ['name' => 'FINANZAS RESIDENCIAL'],
            ['name' => 'FUNDACION'],
            ['name' => 'GEB'],
            ['name' => 'GOLF'],
            ['name' => 'FINANZAS'],
            ['name' => 'LAVANDERIA'],
            ['name' => 'LOGISTICA'],
            ['name' => 'MANTENIMIENTO'],
            ['name' => 'MARKETING'],
            ['name' => 'MAYORDOMIA'],
            ['name' => 'OBRA'],
            ['name' => 'PRO SHOP'],
            ['name' => 'PROPERTY'],
            ['name' => 'RECEPCION'],
            ['name' => 'RELACIONES PUBLICAS'],
            ['name' => 'RESIDENCIAL'],
            ['name' => 'RESTAURANTE - ACUARIO'],
            ['name' => 'RESTAURANTE - ANDALE BURGUER'],
            ['name' => 'RESTAURANTE - KU´UK'],
            ['name' => 'RESTAURANTE - DOLCHE VITA'],
            ['name' => 'RESTAURANTE - FRUTOS DEL MAR'],
            ['name' => 'RESTAURANTE - DON PABLO'],
            ['name' => 'RESTAURANTE - HINDU THALI'],
            ['name' => 'RESTAURANTE - JOOL BOLOM'],
            ['name' => 'RESTAURANTE - MAIKO'],
            ['name' => 'RESTAURANTE - MASHUA'],
            ['name' => 'RESTAURANTE - THE TRUCK'],
            ['name' => 'RESTAURANTE - CASITA'],
            ['name' => 'RESTAURANTE - CENOTE'],
            ['name' => 'RESTAURANTE - ACUARIO'],
            ['name' => 'RESTAURANTE - GRAN TORTUGA'],
            ['name' => 'RESTAURANTE - YUCATAN'],
            ['name' => 'ROOM SERVICE'],
            ['name' => 'RRHH'],
            ['name' => 'SCUBAQUATIC'],
            ['name' => 'SEGURIDAD'],
            ['name' => 'SERVICIOS COMUNES'],
            ['name' => 'SISTEMAS'],
            ['name' => 'SOLTOUR'],
            ['name' => 'SONIDO TEENS CLUB'],
            ['name' => 'SPA'],
            ['name' => 'TELEFONOS'],
            ['name' => 'TIENDAS'],
            ['name' => 'TRANSPORTACION'],
            ['name' => 'TROPIC ONE'],
            ['name' => 'VENTAS'],
            ['name' => 'VENTAS MEXICO'],
            ['name' => 'VENTAS RECIDENCIAL'],
        ];

        // Agregar los datos a la tabla "hoteles"
        DB::table('departamentos')->insert($datos);
    }
}
