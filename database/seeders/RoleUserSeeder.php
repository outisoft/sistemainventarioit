<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Region;
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

        $user = User::find(1);
        if ($user) {
            $user->assignRole($adminRole);
        }

        if ($user) {
            $region = Region::where('name', 'Mexico')->first();
            if ($region) {
                $user->regions()->attach($region->id);
            }
        }
    }
}
