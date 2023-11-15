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

        Permission::create(['name' => 'home', 'description' => 'Ver dashboard/home'])->syncRoles($adminRole, $proRole, $basicoRole);

        Permission::create(['name' => 'charts.index', 'description' => 'Ver graficas'])->syncRoles($adminRole, $proRole, $basicoRole);

        Permission::create(['name' => 'historial.index', 'description' => 'Ver Historial'])->syncRoles($adminRole, $proRole, $basicoRole);

        Permission::create(['name' => 'inventario.index', 'description' => 'Ver listado de inventario'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'inventario.show', 'description' => 'Ver detalles de inventario'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'inventario.create', 'description' => 'Crear nuevo inventario'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'inventario.edit', 'description' => 'Editar inventario'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'inventario.destroy', 'description' => 'Eliminar inventario'])->syncRoles($adminRole, $proRole, $basicoRole);

        Permission::create(['name' => 'empleados.index', 'description' => 'Ver listado de empleados'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'empleados.show', 'description' => 'Ver detalle de empleado'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'empleados.create', 'description' => 'Registrar nuevos empleados'])->syncRoles($adminRole, $proRole);
        Permission::create(['name' => 'empleados.edit', 'description' => 'Editar Empleados'])->syncRoles($adminRole, $proRole);
        Permission::create(['name' => 'empleados.destroy', 'description' => 'Eliminar Empleados'])->syncRoles($adminRole, $proRole);
        Permission::create(['name' => 'empleados.asignacion', 'description' => 'Asignar equipo a empleados'])->syncRoles($adminRole, $proRole);
        Permission::create(['name' => 'empleados.detalles', 'description' => 'Ver detalles de asignacion'])->syncRoles($adminRole, $proRole, $basicoRole);

        Permission::create(['name' => 'equipos.index', 'description' => 'Ver listado de equipos'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'equipos.show', 'description' => 'Ver detalles de los equipos'])->syncRoles($adminRole, $proRole, $basicoRole);
        Permission::create(['name' => 'equipos.create', 'description' => 'Registrar nuevos equipos'])->syncRoles($adminRole, $proRole);
        Permission::create(['name' => 'equipos.edit', 'description' => 'Editar equipos'])->syncRoles($adminRole, $proRole);
        Permission::create(['name' => 'equipos.destroy', 'description' => 'Eliminar equipos'])->syncRoles($adminRole, $proRole);

        Permission::create(['name' => 'users.index', 'description' => 'Ver listado de usuarios'])->syncRoles($adminRole, $proRole);
        Permission::create(['name' => 'users.show', 'description' => 'Ver detalles de usuarios'])->syncRoles($adminRole, $proRole);
        Permission::create(['name' => 'users.create', 'description' => 'Registrar nuevos usuarios'])->syncRoles($adminRole);
        Permission::create(['name' => 'users.edit', 'description' => 'Editar usuarios'])->syncRoles($adminRole);
        Permission::create(['name' => 'users.destroy', 'description' => 'Eliminar usuarios'])->syncRoles($adminRole);

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
