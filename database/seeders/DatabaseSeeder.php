<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empleado;
use App\Models\Inventario;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            HotelesSeeder::class,
            RolesSeeder::class,
        ]);

        User::factory()->count(8)->create();
        Empleado::factory()->count(30)->create(); // Crea empleados (ajusta el número según tus necesidades)
        Inventario::factory()->count(30)->create();

        /*Role::create(['name' => 'básico']);
        Role::create(['name' => 'pro']);
        Role::create(['name' => 'administrador']);

        Permission::create(['name' => 'ver contenido']);
        Permission::create(['name' => 'editar contenido']);
        Permission::create(['name' => 'eliminar contenido']);*/

        /*$this->call([
            HotelesSeeder::class,
        ]);*/
         //\App\Models\Inventario::factory(5)->create();php

         

         //Empleado::factory()->count(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
