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

        Permission::create(['name' => 'home'])->syncRoles($adminRole, $proRole, $basicoRole);

        Permission::create(['name' => 'inventario.index'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'inventario.show'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'inventario.create'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'inventario.edit'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'inventario.destroy'])->syncRoles($adminRole, $proRole, $basicoRole);

        Permission::create(['name' => 'empleados.index'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'empleados.show'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'empleados.create'])->syncRoles($adminRole, $proRole);
        Permission::create(['name' => 'empleados.edit'])->syncRoles($adminRole, $proRole);
        Permission::create(['name' => 'empleados.destroy'])->syncRoles($adminRole, $proRole);

        Permission::create(['name' => 'equipos.index'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'equipos.show'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'equipos.create'])->syncRoles($adminRole, $proRole);
        Permission::create(['name' => 'equipos.edit'])->syncRoles($adminRole, $proRole);
        Permission::create(['name' => 'equipos.destroy'])->syncRoles($adminRole, $proRole);

        Permission::create(['name' => 'users.index'])->syncRoles($adminRole, $proRole);
        Permission::create(['name' => 'users.show'])->syncRoles($adminRole, $proRole);
        Permission::create(['name' => 'users.create'])->syncRoles($adminRole);
        Permission::create(['name' => 'users.edit'])->syncRoles($adminRole);
        Permission::create(['name' => 'users.destroy'])->syncRoles($adminRole);

        Permission::create(['name' => 'asignacion'])->syncRoles($adminRole, $proRole);

        // Asignar permisos
        /*$crearPermiso = Permission::create(['name' => 'crear-publicación']);
        $editarPermiso = Permission::create(['name' => 'editar-publicación']);
        $verPermiso = Permission::create(['name' => 'ver-publicación']);
        $eliminarPermiso = Permission::create(['name' => 'eliminar-publicación']);
        // Asigna permisos a roles
        $adminRole->givePermissionTo($crearPermiso, $editarPermiso, $verPermiso, $eliminarPermiso);
        $proRole->givePermissionTo($crearPermiso, $editarPermiso, $verPermiso);
        $basicoRole->givePermissionTo($verPermiso);*/

        /*Role::create(['name' => 'básico']);
        Role::create(['name' => 'pro']);
        Role::create(['name' => 'administrador']);

        Permission::create(['name' => 'ver contenido']);
        Permission::create(['name' => 'crear contenido']);
        Permission::create(['name' => 'editar contenido']);
        Permission::create(['name' => 'eliminar contenido']);*/
    }
}
