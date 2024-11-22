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
        $adminRole = Role::create(['name' => 'Administrator']);

        Permission::create(['name' => 'home', 'description' => 'Ver dashboard/home'])->syncRoles($adminRole);

        Permission::create(['name' => 'historial.index', 'description' => 'Ver Historial'])->syncRoles($adminRole);

        Permission::create(['name' => 'empleados.index', 'description' => 'Ver listado de empleados'])->syncRoles($adminRole);
        Permission::create(['name' => 'empleados.show', 'description' => 'Ver detalle de empleado'])->syncRoles($adminRole);
        Permission::create(['name' => 'empleados.create', 'description' => 'Registrar nuevos empleados'])->syncRoles($adminRole);
        Permission::create(['name' => 'empleados.edit', 'description' => 'Editar Empleados'])->syncRoles($adminRole);
        Permission::create(['name' => 'empleados.destroy', 'description' => 'Eliminar Empleados'])->syncRoles($adminRole);
        Permission::create(['name' => 'empleados.asignacion', 'description' => 'Asignar equipo a empleados'])->syncRoles($adminRole);
        Permission::create(['name' => 'empleados.detalles', 'description' => 'Ver detalles de asignacion'])->syncRoles($adminRole);

        Permission::create(['name' => 'equipo.index', 'description' => 'Ver listado de equipos'])->syncRoles($adminRole);
        Permission::create(['name' => 'complements.index', 'description' => 'Ver listado de complementos'])->syncRoles($adminRole);
        Permission::create(['name' => 'complements.create', 'description' => 'Registrar complementos'])->syncRoles($adminRole);
        Permission::create(['name' => 'complements.edit', 'description' => 'Editar complementos'])->syncRoles($adminRole);
        Permission::create(['name' => 'complements.destroy', 'description' => 'Eliminar complementos'])->syncRoles($adminRole);

        Permission::create(['name' => 'desktops.index', 'description' => 'Ver listado de desktops'])->syncRoles($adminRole);
        Permission::create(['name' => 'desktops.show', 'description' => 'Ver detalles de desktop'])->syncRoles($adminRole);
        Permission::create(['name' => 'desktops.create', 'description' => 'Registrar desktops'])->syncRoles($adminRole);
        Permission::create(['name' => 'desktops.edit', 'description' => 'Editar desktops'])->syncRoles($adminRole);
        Permission::create(['name' => 'desktops.destroy', 'description' => 'Eliminar desktops'])->syncRoles($adminRole);

        Permission::create(['name' => 'printers.index', 'description' => 'Ver listado de impresoras'])->syncRoles($adminRole);
        Permission::create(['name' => 'printers.create', 'description' => 'Registrar impresoras'])->syncRoles($adminRole);
        Permission::create(['name' => 'printers.edit', 'description' => 'Editar impresoras'])->syncRoles($adminRole);
        Permission::create(['name' => 'printers.destroy', 'description' => 'Eliminar impresoras'])->syncRoles($adminRole);

        Permission::create(['name' => 'laptops.index', 'description' => 'Ver listado de laptops'])->syncRoles($adminRole);
        Permission::create(['name' => 'laptops.create', 'description' => 'Registrar laptops'])->syncRoles($adminRole);
        Permission::create(['name' => 'laptops.edit', 'description' => 'Editar laptops'])->syncRoles($adminRole);
        Permission::create(['name' => 'laptops.destroy', 'description' => 'Eliminar laptops'])->syncRoles($adminRole);

        Permission::create(['name' => 'tabs.index', 'description' => 'Ver listado de tablets'])->syncRoles($adminRole);
        Permission::create(['name' => 'tabs.create', 'description' => 'Registrar tablets'])->syncRoles($adminRole);
        Permission::create(['name' => 'tabs.edit', 'description' => 'Editar tablets'])->syncRoles($adminRole);
        Permission::create(['name' => 'tabs.destroy', 'description' => 'Eliminar tablets'])->syncRoles($adminRole);

        Permission::create(['name' => 'users.index', 'description' => 'Ver listado de usuarios'])->syncRoles($adminRole);
        Permission::create(['name' => 'users.show', 'description' => 'Ver detalles de usuarios'])->syncRoles($adminRole);
        Permission::create(['name' => 'users.create', 'description' => 'Registrar nuevos usuarios'])->syncRoles($adminRole);
        Permission::create(['name' => 'users.edit', 'description' => 'Editar usuarios'])->syncRoles($adminRole);
        Permission::create(['name' => 'users.destroy', 'description' => 'Eliminar usuarios'])->syncRoles($adminRole);

        Permission::create(['name' => 'roles.index', 'description' => 'Ver listado de roles'])->syncRoles($adminRole);
        /*Permission::create(['name' => 'roles.show', 'description' => 'Ver detalles de rol'])->syncRoles($adminRole);*/
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

        /*Permission::create(['name' => 'maintenances.index', 'description' => 'Ver listado de mantenimiento'])->syncRoles($adminRole);
        Permission::create(['name' => 'maintenances.show', 'description' => 'Ver detalles de mantenimiento'])->syncRoles($adminRole);
        Permission::create(['name' => 'maintenances.create', 'description' => 'Registrar mantenimiento'])->syncRoles($adminRole);
        Permission::create(['name' => 'maintenances.edit', 'description' => 'Editar mantenimiento'])->syncRoles($adminRole);
        Permission::create(['name' => 'maintenances.destroy', 'description' => 'Eliminar mantenimiento'])->syncRoles($adminRole);*/

        Permission::create(['name' => 'licenses.index', 'description' => 'Ver listado de licencias'])->syncRoles($adminRole);
        Permission::create(['name' => 'licenses.show', 'description' => 'Ver detalles de licencias'])->syncRoles($adminRole);
        Permission::create(['name' => 'licenses.create', 'description' => 'Registrar licencias'])->syncRoles($adminRole);
        Permission::create(['name' => 'licenses.edit', 'description' => 'Editar licencias'])->syncRoles($adminRole);
        Permission::create(['name' => 'licenses.destroy', 'description' => 'Eliminar licencias'])->syncRoles($adminRole);

        Permission::create(['name' => 'hotels.index', 'description' => 'Ver listado de hoteles'])->syncRoles($adminRole);
        Permission::create(['name' => 'hotels.create', 'description' => 'Registrar hoteles'])->syncRoles($adminRole);
        Permission::create(['name' => 'hotels.edit', 'description' => 'Editar hoteles'])->syncRoles($adminRole);
        Permission::create(['name' => 'hotels.destroy', 'description' => 'Eliminar hoteles'])->syncRoles($adminRole);

        Permission::create(['name' => 'departments.index', 'description' => 'Ver listado de departamentos'])->syncRoles($adminRole);
        Permission::create(['name' => 'departments.create', 'description' => 'Registrar departamentos'])->syncRoles($adminRole);
        Permission::create(['name' => 'departments.edit', 'description' => 'Editar departamentos'])->syncRoles($adminRole);
        Permission::create(['name' => 'departments.destroy', 'description' => 'Eliminar departamentos'])->syncRoles($adminRole);

        Permission::create(['name' => 'switches.index', 'description' => 'Ver listado de switches'])->syncRoles($adminRole);
        Permission::create(['name' => 'switches.create', 'description' => 'Registrar switches'])->syncRoles($adminRole);
        Permission::create(['name' => 'switches.edit', 'description' => 'Editar switches'])->syncRoles($adminRole);
        Permission::create(['name' => 'switches.destroy', 'description' => 'Eliminar switches'])->syncRoles($adminRole);

        Permission::create(['name' => 'access_points.index', 'description' => 'Ver listado de Access Points'])->syncRoles($adminRole);
        Permission::create(['name' => 'access_points.create', 'description' => 'Registrar Access Points'])->syncRoles($adminRole);
        Permission::create(['name' => 'access_points.edit', 'description' => 'Editar Access Points'])->syncRoles($adminRole);
        Permission::create(['name' => 'access_points.destroy', 'description' => 'Eliminar Access Points'])->syncRoles($adminRole);

        Permission::create(['name' => 'phones.index', 'description' => 'Ver listado de Telefonos'])->syncRoles($adminRole);
        Permission::create(['name' => 'phones.create', 'description' => 'Registrar Telefonos'])->syncRoles($adminRole);
        Permission::create(['name' => 'phones.edit', 'description' => 'Editar Telefonos'])->syncRoles($adminRole);
        Permission::create(['name' => 'phones.destroy', 'description' => 'Eliminar Telefonos'])->syncRoles($adminRole);

        Permission::create(['name' => 'coming2.index', 'description' => 'Ver listado de registros de coming2'])->syncRoles($adminRole);
        Permission::create(['name' => 'coming2.show', 'description' => 'Ver detalles de regitros coming2'])->syncRoles($adminRole);
        Permission::create(['name' => 'coming2.create', 'description' => 'Crear registros de coming2'])->syncRoles($adminRole);
        Permission::create(['name' => 'coming2.edit', 'description' => 'Editar registros de coming2'])->syncRoles($adminRole);
        Permission::create(['name' => 'coming2.destroy', 'description' => 'Eliminar registros de coming2'])->syncRoles($adminRole);

        Permission::create(['name' => 'other.index', 'description' => 'Ver listado de registros de otros'])->syncRoles($adminRole);
        Permission::create(['name' => 'other.show', 'description' => 'Ver detalles de regitros otros'])->syncRoles($adminRole);
        Permission::create(['name' => 'other.create', 'description' => 'Crear registros de otros'])->syncRoles($adminRole);
        Permission::create(['name' => 'other.edit', 'description' => 'Editar registros de otros'])->syncRoles($adminRole);
        Permission::create(['name' => 'other.destroy', 'description' => 'Eliminar registros de otros'])->syncRoles($adminRole);

        // Crear permisos 
        Permission::create(['name' => 'manage Mexico records', 'description' => 'Mange Mexico record']); 
        Permission::create(['name' => 'manage Spain records', 'description' => 'Manage Spain Records']); 
        // Crear roles y asignar permisos 
        $mexicoRole = Role::create(['name' => 'Mexico user']); 
        $mexicoRole->givePermissionTo('manage Mexico records'); 
        $spainRole = Role::create(['name' => 'Spain user']); 
        $spainRole->givePermissionTo('manage Spain records');
    }
}
