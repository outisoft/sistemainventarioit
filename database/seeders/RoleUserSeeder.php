<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        $adminRole = Role::firstOrCreate(['name' => 'Administrator']);

        // Asignar roles a usuarios
        $adminUser = User::find(1); // Asumiendo que el usuario con ID 1 es el admin
        if ($adminUser) {
            $adminUser->assignRole($adminRole);
        }
    }
}
