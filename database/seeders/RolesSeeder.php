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
        $admin = Role::create(['name' => 'Administrator']);
        $adminRegion = Role::create(['name' => 'Regional Administrator']);
        $support = Role::create(['name' => 'Support IT']);

        Permission::create(['name' => 'home', 'description' => 'Ver dashboard/home'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'historial.index', 'description' => 'Ver Historial'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'access_points.index', 'description' => 'Ver listado de Access Points'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'access_points.create', 'description' => 'Registrar Access Points'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'access_points.show', 'description' => 'Ver detalles de Access Points'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'access_points.edit', 'description' => 'Editar Access Points'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'access_points.destroy', 'description' => 'Eliminar Access Points'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'coming2.index', 'description' => 'Ver listado de registros de coming2'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'coming2.show', 'description' => 'Ver detalles de regitros coming2'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'coming2.create', 'description' => 'Crear registros de coming2'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'coming2.edit', 'description' => 'Editar registros de coming2'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'coming2.destroy', 'description' => 'Eliminar registros de coming2'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'equipo.index', 'description' => 'Ver listado de equipos'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'equipo.show', 'description' => 'Asignar complemento a equipo'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'details', 'description' => 'Ver detalles de equipos'])->syncRoles($admin, $adminRegion, $support);
        
        Permission::create(['name' => 'complements.index', 'description' => 'Ver listado de complementos'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'complements.create', 'description' => 'Registrar complementos'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'complements.edit', 'description' => 'Editar complementos'])->syncRoles($admin, $adminRegion, $support);        
        Permission::create(['name' => 'complements.show', 'description' => 'Ver detalles de complementsos'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'complements.destroy', 'description' => 'Eliminar complementos'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'desktops.index', 'description' => 'Ver listado de desktops'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'desktops.show', 'description' => 'Ver detalles de desktop'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'desktops.create', 'description' => 'Registrar desktops'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'desktops.edit', 'description' => 'Editar desktops'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'desktops.destroy', 'description' => 'Eliminar desktops'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'empleados.index', 'description' => 'Ver listado de empleados'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'empleados.show', 'description' => 'Ver detalle de empleado'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'empleados.create', 'description' => 'Registrar nuevos empleados'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'empleados.edit', 'description' => 'Editar Empleados'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'empleados.destroy', 'description' => 'Eliminar Empleados'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'empleados.asignacion', 'description' => 'Asignar equipo a empleados'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'empleados.detalles', 'description' => 'Ver detalles de asignacion'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'laptops.index', 'description' => 'Ver listado de laptops'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'laptops.create', 'description' => 'Registrar laptops'])->syncRoles($admin, $adminRegion, $support);        
        Permission::create(['name' => 'laptops.show', 'description' => 'Ver detalles de laptops'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'laptops.edit', 'description' => 'Editar laptops'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'laptops.destroy', 'description' => 'Eliminar laptops'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'licenses.index', 'description' => 'Ver listado de licencias'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'licenses.show', 'description' => 'Ver detalles de licencias'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'licenses.create', 'description' => 'Registrar licencias'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'licenses.edit', 'description' => 'Editar licencias'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'licenses.destroy', 'description' => 'Eliminar licencias'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'mobile.index', 'description' => 'Ver listado de Telefonos mobiles'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'mobile.create', 'description' => 'Registrar Telefonos mobiles'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'mobile.show', 'description' => 'Ver detalles de mobiles'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'mobile.edit', 'description' => 'Editar Telefonos mobiles'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'mobile.destroy', 'description' => 'Eliminar Telefonos mobiles'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'other.index', 'description' => 'Ver listado de registros de otros'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'other.show', 'description' => 'Ver detalles de regitros otros'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'other.create', 'description' => 'Crear registros de otros'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'other.edit', 'description' => 'Editar registros de otros'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'other.destroy', 'description' => 'Eliminar registros de otros'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'phones.index', 'description' => 'Ver listado de Telefonos'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'phones.create', 'description' => 'Registrar Telefonos'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'phones.show', 'description' => 'Ver detalles de phones'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'phones.edit', 'description' => 'Editar Telefonos'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'phones.destroy', 'description' => 'Eliminar Telefonos'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'printers.index', 'description' => 'Ver listado de impresoras'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'printers.create', 'description' => 'Registrar impresoras'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'printers.show', 'description' => 'Ver detalles de impresoras'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'printers.edit', 'description' => 'Editar impresoras'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'printers.destroy', 'description' => 'Eliminar impresoras'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'switches.index', 'description' => 'Ver listado de switches'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'switches.create', 'description' => 'Registrar switches'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'switches.show', 'description' => 'Ver detalles de switches'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'switches.edit', 'description' => 'Editar switches'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'switches.destroy', 'description' => 'Eliminar switches'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'tabs.index', 'description' => 'Ver listado de tablets'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'tabs.create', 'description' => 'Registrar tablets'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'tabs.show', 'description' => 'Ver detalles de tablets'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'tabs.edit', 'description' => 'Editar tablets'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'tabs.destroy', 'description' => 'Eliminar tablets'])->syncRoles($admin, $adminRegion, $support);

        Permission::create(['name' => 'tpvs.index', 'description' => 'Ver listado de tpvs'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'tpvs.show', 'description' => 'Ver detalles de tpvs'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'tpvs.create', 'description' => 'Registrar nueva tpvs'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'tpvs.edit', 'description' => 'Editar tpvs'])->syncRoles($admin, $adminRegion, $support);
        Permission::create(['name' => 'tpvs.destroy', 'description' => 'Eliminar tpvs'])->syncRoles($admin, $adminRegion, $support);

        //Admin Role

        Permission::create(['name' => 'region.index', 'description' => 'Ver listado de regiones'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'region.create', 'description' => 'Registrar regiones'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'region.edit', 'description' => 'Editar regiones'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'region.destroy', 'description' => 'Eliminar regiones'])->syncRoles($admin, $adminRegion);

        Permission::create(['name' => 'hotels.index', 'description' => 'Ver listado de hoteles'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'hotels.create', 'description' => 'Registrar hoteles'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'hotels.edit', 'description' => 'Editar hoteles'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'hotels.destroy', 'description' => 'Eliminar hoteles'])->syncRoles($admin, $adminRegion);

        Permission::create(['name' => 'departments.index', 'description' => 'Ver listado de departamentos'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'departments.create', 'description' => 'Registrar departamentos'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'departments.edit', 'description' => 'Editar departamentos'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'departments.destroy', 'description' => 'Eliminar departamentos'])->syncRoles($admin, $adminRegion);

        Permission::create(['name' => 'users.index', 'description' => 'Ver listado de usuarios'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'users.show', 'description' => 'Ver detalles de usuarios'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'users.create', 'description' => 'Registrar nuevos usuarios'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'users.edit', 'description' => 'Editar usuarios'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'users.destroy', 'description' => 'Eliminar usuarios'])->syncRoles($admin, $adminRegion);

        Permission::create(['name' => 'roles.index', 'description' => 'Ver listado de roles'])->syncRoles($admin, $adminRegion);
        /*Permission::create(['name' => 'roles.show', 'description' => 'Ver detalles de rol'])->syncRoles($admin);*/
        Permission::create(['name' => 'roles.create', 'description' => 'Registrar nuevos roles'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'roles.edit', 'description' => 'Editar roles'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'roles.destroy', 'description' => 'Eliminar roles'])->syncRoles($admin, $adminRegion);

        Permission::create(['name' => 'backup.index', 'description' => 'Ver listado de backup'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'backup.create', 'description' => 'Cear backup'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'backup.download', 'description' => 'Descargar backup'])->syncRoles($admin, $adminRegion);
        Permission::create(['name' => 'backup.restore', 'description' => 'Restaurar backup'])->syncRoles($admin, $adminRegion);
    }
}
