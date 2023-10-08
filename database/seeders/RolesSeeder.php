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
        // Crear roles
        $adminRole = Role::create(['name' => 'administrador']);
        $proRole = Role::create(['name' => 'pro']);
        $basicoRole = Role::create(['name' => 'basico']);

        // Asignar permisos
        $crearPermiso = Permission::create(['name' => 'crear-publicación']);
        $editarPermiso = Permission::create(['name' => 'editar-publicación']);
        $verPermiso = Permission::create(['name' => 'ver-publicación']);
        $eliminarPermiso = Permission::create(['name' => 'eliminar-publicación']);
        // Asigna permisos a roles
        $adminRole->givePermissionTo($crearPermiso, $editarPermiso, $verPermiso, $eliminarPermiso);
        $proRole->givePermissionTo($crearPermiso, $editarPermiso, $verPermiso);
        $basicoRole->givePermissionTo($verPermiso);

        /*Role::create(['name' => 'básico']);
        Role::create(['name' => 'pro']);
        Role::create(['name' => 'administrador']);

        Permission::create(['name' => 'ver contenido']);
        Permission::create(['name' => 'crear contenido']);
        Permission::create(['name' => 'editar contenido']);
        Permission::create(['name' => 'eliminar contenido']);*/
    }
}
