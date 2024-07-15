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
        $adminRole = Role::create(['name' => 'Administrador']);
        $soporteRole = Role::create(['name' => 'Soporte']);
        $basicoRole = Role::create(['name' => 'Basico']);

        Permission::create(['name' => 'home', 'description' => 'Ver dashboard/home'])->syncRoles($adminRole, $soporteRole, $basicoRole);

        Permission::create(['name' => 'charts.index', 'description' => 'Ver graficas'])->syncRoles($adminRole, $soporteRole, $basicoRole);

        Permission::create(['name' => 'historial.index', 'description' => 'Ver Historial'])->syncRoles($adminRole, $soporteRole, $basicoRole);

        Permission::create(['name' => 'inventario.index', 'description' => 'Ver listado de inventario'])->syncRoles($adminRole, $soporteRole, $basicoRole);
        Permission::create(['name' => 'inventario.show', 'description' => 'Ver detalles de inventario'])->syncRoles($adminRole, $soporteRole, $basicoRole);
        Permission::create(['name' => 'inventario.create', 'description' => 'Crear nuevo inventario'])->syncRoles($adminRole, $soporteRole, $basicoRole);
        Permission::create(['name' => 'inventario.edit', 'description' => 'Editar inventario'])->syncRoles($adminRole, $soporteRole, $basicoRole);
        Permission::create(['name' => 'inventario.destroy', 'description' => 'Eliminar inventario'])->syncRoles($adminRole, $soporteRole, $basicoRole);

        Permission::create(['name' => 'empleados.index', 'description' => 'Ver listado de empleados'])->syncRoles($adminRole, $soporteRole, $basicoRole);
        Permission::create(['name' => 'empleados.show', 'description' => 'Ver detalle de empleado'])->syncRoles($adminRole, $soporteRole, $basicoRole);
        Permission::create(['name' => 'empleados.create', 'description' => 'Registrar nuevos empleados'])->syncRoles($adminRole, $soporteRole);
        Permission::create(['name' => 'empleados.edit', 'description' => 'Editar Empleados'])->syncRoles($adminRole, $soporteRole);
        Permission::create(['name' => 'empleados.destroy', 'description' => 'Eliminar Empleados'])->syncRoles($adminRole, $soporteRole);
        Permission::create(['name' => 'empleados.asignacion', 'description' => 'Asignar equipo a empleados'])->syncRoles($adminRole, $soporteRole);
        Permission::create(['name' => 'empleados.detalles', 'description' => 'Ver detalles de asignacion'])->syncRoles($adminRole, $soporteRole, $basicoRole);

        Permission::create(['name' => 'equipo.index', 'description' => 'Ver listado de equipos'])->syncRoles($adminRole, $soporteRole, $basicoRole);
        Permission::create(['name' => 'equipo.show', 'description' => 'Ver detalles de los equipos'])->syncRoles($adminRole, $soporteRole, $basicoRole);
        Permission::create(['name' => 'equipo.create', 'description' => 'Registrar nuevos equipos'])->syncRoles($adminRole, $soporteRole);
        Permission::create(['name' => 'equipo.edit', 'description' => 'Editar equipos'])->syncRoles($adminRole, $soporteRole);
        Permission::create(['name' => 'equipo.destroy', 'description' => 'Eliminar equipos'])->syncRoles($adminRole, $soporteRole);

        Permission::create(['name' => 'users.index', 'description' => 'Ver listado de usuarios'])->syncRoles($adminRole, $soporteRole);
        Permission::create(['name' => 'users.show', 'description' => 'Ver detalles de usuarios'])->syncRoles($adminRole, $soporteRole);
        Permission::create(['name' => 'users.create', 'description' => 'Registrar nuevos usuarios'])->syncRoles($adminRole);
        Permission::create(['name' => 'users.edit', 'description' => 'Editar usuarios'])->syncRoles($adminRole);
        Permission::create(['name' => 'users.destroy', 'description' => 'Eliminar usuarios'])->syncRoles($adminRole);

        Permission::create(['name' => 'roles.index', 'description' => 'Ver listado de roles'])->syncRoles($adminRole);
        Permission::create(['name' => 'roles.show', 'description' => 'Ver detalles de rol'])->syncRoles($adminRole);
        Permission::create(['name' => 'roles.create', 'description' => 'Registrar nuevos roles'])->syncRoles($adminRole);
        Permission::create(['name' => 'roles.edit', 'description' => 'Editar roles'])->syncRoles($adminRole);
        Permission::create(['name' => 'roles.destroy', 'description' => 'Eliminar roles'])->syncRoles($adminRole);

        Permission::create(['name' => 'tablets.index', 'description' => 'Ver listado de tablets'])->syncRoles($adminRole);
        Permission::create(['name' => 'tablets.show', 'description' => 'Ver detalles de tablets'])->syncRoles($adminRole);
        Permission::create(['name' => 'tablets.create', 'description' => 'Registrar nueva tablet'])->syncRoles($adminRole);
        Permission::create(['name' => 'tablets.edit', 'description' => 'Editar tablet'])->syncRoles($adminRole);
        Permission::create(['name' => 'tablets.destroy', 'description' => 'Eliminar tablet'])->syncRoles($adminRole);

        Permission::create(['name' => 'tpvs.index', 'description' => 'Ver listado de tpvs'])->syncRoles($adminRole);
        Permission::create(['name' => 'tpvs.show', 'description' => 'Ver detalles de tpvs'])->syncRoles($adminRole);
        Permission::create(['name' => 'tpvs.create', 'description' => 'Registrar nueva tpvs'])->syncRoles($adminRole);
        Permission::create(['name' => 'tpvs.edit', 'description' => 'Editar tpvs'])->syncRoles($adminRole);
        Permission::create(['name' => 'tpvs.destroy', 'description' => 'Eliminar tpvs'])->syncRoles($adminRole);

        Permission::create(['name' => 'maintenances.index', 'description' => 'Ver listado de mantenimiento'])->syncRoles($adminRole);
        Permission::create(['name' => 'maintenances.show', 'description' => 'Ver detalles de mantenimiento'])->syncRoles($adminRole);
        Permission::create(['name' => 'maintenances.create', 'description' => 'Registrar mantenimiento'])->syncRoles($adminRole);
        Permission::create(['name' => 'maintenances.edit', 'description' => 'Editar mantenimiento'])->syncRoles($adminRole);
        Permission::create(['name' => 'maintenances.destroy', 'description' => 'Eliminar mantenimiento'])->syncRoles($adminRole);

        Permission::create(['name' => 'licenses.index', 'description' => 'Ver listado de licencias'])->syncRoles($adminRole);
        Permission::create(['name' => 'licenses.show', 'description' => 'Ver detalles de licencias'])->syncRoles($adminRole);
        Permission::create(['name' => 'licenses.create', 'description' => 'Registrar licencias'])->syncRoles($adminRole);
        Permission::create(['name' => 'licenses.edit', 'description' => 'Editar licencias'])->syncRoles($adminRole);
        Permission::create(['name' => 'licenses.destroy', 'description' => 'Eliminar licencias'])->syncRoles($adminRole);

        // Asignar permisos
        /*$crearPermiso = Permission::create(['name' => 'crear-publicación']);
        $editarPermiso = Permission::create(['name' => 'editar-publicación']);
        $verPermiso = Permission::create(['name' => 'ver-publicación']);
        $eliminarPermiso = Permission::create(['name' => 'eliminar-publicación']);
        // Asigna permisos a roles
        $adminRole->givePermissionTo($crearPermiso, $editarPermiso, $verPermiso, $eliminarPermiso);
        $soporteRole->givePermissionTo($crearPermiso, $editarPermiso, $verPermiso);
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
