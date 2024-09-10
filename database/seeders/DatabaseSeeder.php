<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empleado;
use App\Models\Inventario;
use App\Models\User;
use App\Models\Equipo;
use App\Models\Tablet;
use App\Models\Tpv;
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
            RoleUserSeeder::class,
            DepartamentoSeeder::class,
            TipoSeeder::class,
            PolicySeeder::class,
        ]);

        //Tablet::factory()->count(10)->create();
        //Tpv::factory()->count(10)->create();
        //User::factory()->count(8)->create();
        //Empleado::factory()->count(150)->create(); // Crea empleados (ajusta el número según tus necesidades)
        //Inventario::factory()->count(30)->create();
        //Equipo::factory()->count(100)->create();
    }
}
