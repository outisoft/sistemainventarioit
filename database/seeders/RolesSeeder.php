<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::create(['name' => 'básico']);
        Role::create(['name' => 'pro']);
        Role::create(['name' => 'administrador']);

        Permission::create(['name' => 'ver contenido']);
        Permission::create(['name' => 'editar contenido']);
        Permission::create(['name' => 'eliminar contenido']);
    }
}
